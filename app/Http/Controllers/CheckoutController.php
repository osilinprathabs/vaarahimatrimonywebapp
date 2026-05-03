<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckoutController extends Controller
{
    private $api;

    public function __construct()
    {
        $gateway = DB::table('payment_gateways')->where('name', 'razorpay')->first();
        if ($gateway && $gateway->razorpay_key && $gateway->razorpay_secret) {
            $this->api = new Api($gateway->razorpay_key, $gateway->razorpay_secret);
        }
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = DB::table('plans')->find($request->plan_id);
        $user = Auth::user();

        if (!$this->api) {
            return back()->with('error', 'Payment gateway is not configured properly.');
        }

        // Create Razorpay Order
        try {
            $order = $this->api->order->create([
                'receipt' => 'order_rcptid_' . $user->id . '_' . time(),
                'amount' => $plan->amount * 100, // in paise
                'currency' => 'INR',
                'notes' => [
                    'plan_id' => $plan->id,
                    'user_id' => $user->id,
                ]
            ]);

            return view('checkout.razorpay', [
                'order' => $order,
                'plan' => $plan,
                'user' => $user,
                'razorpay_key' => DB::table('payment_gateways')->where('name', 'razorpay')->value('razorpay_key')
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error initiating payment: ' . $e->getMessage());
        }
    }

    public function handleWebhook(Request $request)
    {
        $gateway = DB::table('payment_gateways')->where('name', 'razorpay')->first();
        $webhookSecret = $gateway->webhook_secret; // Updated to match user's new column
        
        $signature = $request->header('X-Razorpay-Signature');
        $payload = $request->getContent();

        // Verify Signature
        try {
            $this->api->utility->verifyWebhookSignature($payload, $signature, $webhookSecret);
            
            $data = json_decode($payload, true);
            
            if ($data['event'] == 'payment.captured') {
                $payment = $data['payload']['payment']['entity'];
                $orderId = $payment['order_id'];
                
                // Fetch order details from Razorpay to get notes
                $rzpOrder = $this->api->order->fetch($orderId);
                $planId = $rzpOrder['notes']['plan_id'];
                $userId = $rzpOrder['notes']['user_id'];
                
                $this->activatePlan($userId, $planId, $payment['id'], $payment['amount'] / 100);
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Log error
            \Log::error('Razorpay Webhook Error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 400);
        }
    }

    private function activatePlan($userId, $planId, $paymentId, $amount)
    {
        $user = User::find($userId);
        $plan = DB::table('plans')->find($planId);

        if (!$user || !$plan) return;

        // Update User Plan
        $user->update([
            'plan' => $plan->name,
            'plan_validity' => $plan->validity,
            'status' => 1,
        ]);

        // Record Payment
        DB::table('payments')->insert([
            'member_id' => $user->id,
            'plan_id' => $plan->id,
            'amount' => $amount,
            'payment_id' => $paymentId,
            'payment_date' => now(),
            'status' => 'Success',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign Plan with Interest Tracking
        DB::table('plan_assign')->updateOrInsert(
            ['member_id' => $user->id],
            [
                'plan_id' => $plan->id,
                'plan_start_date' => now(),
                'plan_end_date' => now()->addDays($plan->validity),
                'total_interests' => $plan->interest,
                'used_interests' => 0,
                'plan_status' => 'Active',
                'updated_at' => now(),
            ]
        );
    }
}
