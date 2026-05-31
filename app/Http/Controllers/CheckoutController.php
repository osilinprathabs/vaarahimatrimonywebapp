<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    private $api;
    private $razorpayKeyId;
    private $webhookSecret;

    public function __construct()
    {
        // 1. Try reading from environment config first
        $keyId = env('RAZORPAY_KEY_ID');
        $keySecret = env('RAZORPAY_KEY_SECRET');
        $this->webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');

        // 2. If not defined in .env, fallback to database settings
        if (empty($keyId) || empty($keySecret)) {
            $gateway = DB::table('payment_gateways')->where('name', 'razorpay')->first();
            if ($gateway && isset($gateway->publishable_key) && isset($gateway->secret_key)) {
                $keyId = $gateway->publishable_key;
                $keySecret = $gateway->secret_key;

                // Auto-heal swapped Key ID and Secret in DB
                if (strpos($gateway->secret_key, 'rzp_') === 0) {
                    $keyId = $gateway->secret_key;
                    $keySecret = $gateway->publishable_key;
                }

                $this->webhookSecret = $gateway->webhook_secret;
            }
        }

        if (!empty($keyId) && !empty($keySecret)) {
            $this->razorpayKeyId = $keyId;
            $this->api = new Api($keyId, $keySecret);
        }
    }

    /**
     * Initiate standard plan package payment.
     */
    public function initiatePayment(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = DB::table('plans')->find($request->plan_id);
        $user = Auth::user();

        // Enforce active plan constraint: prevent new payment if current plan is active and unexpired
        $planAssign = $user->getPlanDetails();
        $hasActivePremiumPlan = false;
        if ($planAssign && $planAssign->plan_status === 'Active' && $planAssign->plan_end_date) {
            $hasActivePremiumPlan = \Carbon\Carbon::parse($planAssign->plan_end_date)->isFuture();
        }
        if (strtolower($user->plan) === 'free' || empty($user->plan)) {
            $hasActivePremiumPlan = false;
        }

        // Allow buying a new plan if interests are fully used up
        if ($planAssign && $planAssign->used_interests >= $planAssign->total_interests) {
            $hasActivePremiumPlan = false;
        }

        if ($hasActivePremiumPlan) {
            return back()->with('error', 'You already have an active Premium plan. You can purchase a new plan once your current plan expires on ' . \Carbon\Carbon::parse($planAssign->plan_end_date)->format('d M Y') . '.');
        }

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
                    'type' => 'plan',
                    'plan_id' => $plan->id,
                    'user_id' => $user->id,
                ]
            ]);

            return view('checkout.razorpay', [
                'order' => $order,
                'plan' => $plan,
                'user' => $user,
                'razorpay_key' => $this->razorpayKeyId
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error initiating payment: ' . $e->getMessage());
        }
    }

    /**
     * Initiate purchase for Extra Interest Add-on booster.
     */
 
    /**
     * Secure Webhook Router.
     */
    public function handleWebhook(Request $request)
    {
        $webhookSecret = $this->webhookSecret;
        if (empty($webhookSecret)) {
            $gateway = DB::table('payment_gateways')->where('name', 'razorpay')->first();
            $webhookSecret = $gateway->webhook_secret ?? null;
        }
        
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
                $type = $rzpOrder['notes']['type'] ?? 'plan';
                $userId = $rzpOrder['notes']['user_id'];
                
                if ($type === 'addon') {
                    $interests = $rzpOrder['notes']['interests'];
                    $addonName = $rzpOrder['notes']['addon_name'];
                    $this->activateAddon($userId, $interests, $addonName, $payment['id'], $payment['amount'] / 100);
                } else {
                    $planId = $rzpOrder['notes']['plan_id'];
                    $this->activatePlan($userId, $planId, $payment['id'], $payment['amount'] / 100);
                }
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            \Log::error('Razorpay Webhook Error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 400);
        }
    }

    /**
     * Assign / Update Primary Membership Plan.
     */
    private function activatePlan($userId, $planId, $paymentId, $amount, $paymentTime = null)
    {
        $user = User::find($userId);
        $plan = DB::table('plans')->find($planId);

        if (!$user || !$plan) return;

        // Update User Profile Plan
        $user->plan = $plan->name;
        $user->plan_validity = now()->addDays($plan->validity)->toDateString();
        $user->status = 1;
        $user->save();

        $paymentDate = $paymentTime ? \Carbon\Carbon::createFromTimestamp($paymentTime)->toDateTimeString() : now()->toDateTimeString();

        // Insert Transaction log (filling both transaction_id and payment_id safely)
        DB::table('payments')->insert([
            'member_id' => $user->id,
            'plan_id' => $plan->id,
            'amount' => $amount,
            'transaction_id' => $paymentId,
            'payment_date' => $paymentDate,
            'status' => 'Success',
            'remarks' => "Upgraded Plan Package to " . $plan->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign plan metrics with Interest allocation
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

    /**
     * Activate Extra Interests Addon Package.
     */
    private function activateAddon($userId, $interests, $addonName, $paymentId, $amount, $paymentTime = null)
    {
        $user = User::find($userId);
        if (!$user) return;

        $paymentDate = $paymentTime ? \Carbon\Carbon::createFromTimestamp($paymentTime)->toDateTimeString() : now()->toDateTimeString();

        // Record booster payment transaction details
        DB::table('payments')->insert([
            'member_id' => $user->id,
            'plan_id' => null,
            'amount' => $amount,
            'transaction_id' => $paymentId,
            'payment_date' => $paymentDate,
            'status' => 'Success',
            'remarks' => "Booster Addon: " . $addonName . " (+ " . $interests . " Extra Interest Credits)",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Retrieve existing assignment and safely increment total_interests limit
        $assign = DB::table('plan_assign')->where('member_id', $user->id)->first();
        if ($assign) {
            DB::table('plan_assign')->where('member_id', $user->id)->update([
                'total_interests' => $assign->total_interests + $interests,
                'updated_at' => now(),
            ]);
        } else {
            // Safe fallback if user has no initial plan
            DB::table('plan_assign')->insert([
                'member_id' => $user->id,
                'plan_id' => 1, // Default free/basic plan reference
                'plan_start_date' => now(),
                'plan_end_date' => now()->addDays(30),
                'total_interests' => $interests,
                'used_interests' => 0,
                'plan_status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function billingHistory(Request $request): View
    {
        $user = $request->user();
        
        $payments = DB::table('payments')
            ->leftJoin('plans', 'payments.plan_id', '=', 'plans.id')
            ->select('payments.*', 'plans.name as plan_name')
            ->where('payments.member_id', $user->id)
            ->orderBy('payments.id', 'desc')
            ->get();

        $planAssign = $user->getPlanDetails();

        // Retrieve all active available plans
        $availablePlans = DB::table('plans')->where('status', 1)->orderBy('amount', 'asc')->get();

        return view('profile.billing', compact('user', 'payments', 'planAssign', 'availablePlans'));
    }

    /**
     * Generate print/view invoice slip.
     */
    public function viewInvoice(Request $request, $id)
    {
        $user = $request->user();
        
        $payment = DB::table('payments')
            ->leftJoin('plans', 'payments.plan_id', '=', 'plans.id')
            ->select('payments.*', 'plans.name as plan_name')
            ->where('payments.member_id', $user->id)
            ->where('payments.id', $id)
            ->first();

        if (!$payment) {
            abort(404, 'Invoice not found.');
        }

        return view('profile.invoice', compact('user', 'payment'));
    }

    /**
     * Frontend Direct Payment Success Callback Signature Verification Endpoint
     */
    public function handleCallback(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required',
        ]);

        if (!$this->api) {
            return redirect()->route('profile.billing')->with('error', 'Payment gateway is not configured properly.');
        }

        try {
            // Verify payment signature
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];
            
            $this->api->utility->verifyPaymentSignature($attributes);

            // Fetch order details from Razorpay to get notes
            $rzpOrder = $this->api->order->fetch($request->razorpay_order_id);
            $type = $rzpOrder['notes']['type'] ?? 'plan';
            $userId = $rzpOrder['notes']['user_id'];
            
            // Retrieve exact payment transaction timestamp
            $rzpPayment = $this->api->payment->fetch($request->razorpay_payment_id);
            $paymentTime = $rzpPayment['created_at'] ?? null;
            
            // Check if transaction is already recorded to prevent duplicate credits/logging
            $exists = DB::table('payments')->where('transaction_id', $request->razorpay_payment_id)->exists();
            if (!$exists) {
                if ($type === 'addon') {
                    $interests = $rzpOrder['notes']['interests'];
                    $addonName = $rzpOrder['notes']['addon_name'];
                    $this->activateAddon($userId, $interests, $addonName, $request->razorpay_payment_id, $rzpOrder['amount'] / 100, $paymentTime);
                } else {
                    $planId = $rzpOrder['notes']['plan_id'];
                    $this->activatePlan($userId, $planId, $request->razorpay_payment_id, $rzpOrder['amount'] / 100, $paymentTime);
                }
            }

            return redirect()->route('profile.billing')->with('success', 'Your payment was successful and plan activated!');
        } catch (\Exception $e) {
            return redirect()->route('profile.billing')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }
}
