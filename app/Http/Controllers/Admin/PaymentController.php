<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Plan;

class PaymentController extends Controller
{ 
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        $payments = DB::table('payments')
            ->leftJoin('free_user', 'payments.member_id', '=', 'free_user.id')
            ->leftJoin('plans', 'payments.plan_id', '=', 'plans.id')
            ->select('payments.*', 'free_user.name', 'free_user.gender', 'free_user.mobileno', 'free_user.userid', 'plans.name as plan_name')
            ->orderBy('payments.id', 'desc')
            ->paginate(25);
        return view('admin.payments.list', compact('payments'));
    }

    /**
     * Display a listing of plans.
     */
    public function plans()
    {
        $plans = DB::table('plans')->orderBy('id')->get();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Create a new plan.
     */
    public function storePlan(Request $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $data['image'] = $imageName;
        }
        $data['status'] = 1;
        Plan::create($data);

        return redirect()->route('admin.plans')->with('success', 'Plan created successfully.');
    }

    /**
     * Update an existing plan.
     */
    public function updatePlan(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $data['image'] = $imageName;
        }
        DB::table('plans')->where('id', $id)->update($data);

        return redirect()->route('admin.plans')->with('success', 'Plan updated successfully.');
    }

    /**
     * Assign a plan to a member.
     */
    public function assignPlan(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:free_user,id',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = DB::table('plans')->where('id', $request->plan_id)->first();
        
        DB::table('plan_assign')->updateOrInsert(
            ['member_id' => $request->member_id],
            [
                'plan_id' => $request->plan_id,
                'plan_start_date' => now(),
                'plan_end_date' => now()->addDays($plan->validity),
                'plan_status' => 'Active'
            ]
        );

        User::where('id', $request->member_id)->update(['isplan' => 1]);

        return back()->with('success', 'Plan assigned successfully.');
    }

    /**
     * Approve and verify a pending payment, activating the member's premium plan.
     */
    public function approvePayment($id)
    {
        $payment = DB::table('payments')->where('id', $id)->first();
        if (!$payment) {
            return back()->with('error', 'Payment transaction not found.');
        }

        // 1. Update payment status to Approved
        DB::table('payments')->where('id', $id)->update([
            'status' => 'Approved',
            'updated_at' => now()
        ]);

        // 2. Fetch the plan details
        $plan = DB::table('plans')->where('id', $payment->plan_id)->first();
        if ($plan) {
            // 3. Assign or update plan status inside plan_assign
            DB::table('plan_assign')->updateOrInsert(
                ['member_id' => $payment->member_id],
                [
                    'plan_id' => $payment->plan_id,
                    'plan_start_date' => now(),
                    'plan_end_date' => now()->addDays((int)$plan->validity),
                    'total_interests' => (int)($plan->interest ?? 50),
                    'used_interests' => 0,
                    'plan_status' => 'Active',
                    'updated_at' => now()
                ]
            );

            // 4. Set the member as a Premium/Active Plan user
            User::where('id', $payment->member_id)->update(['isplan' => 1]);
        }

        return back()->with('success', 'Payment verified and Premium Plan activated successfully.');
    }

    /**
     * Export payments list to CSV, Excel, or PDF print.
     */
    public function exportPayments(Request $request)
    {
        $query = DB::table('payments')
            ->leftJoin('free_user', 'payments.member_id', '=', 'free_user.id')
            ->leftJoin('plans', 'payments.plan_id', '=', 'plans.id')
            ->select('payments.*', 'free_user.name', 'free_user.gender', 'free_user.mobileno', 'free_user.userid', 'plans.name as plan_name');

        if ($request->gender) {
            $query->where('free_user.gender', $request->gender);
        }

        if ($request->status) {
            $query->where('payments.status', $request->status);
        }

        $payments = $query->orderBy('payments.id', 'desc')->get();

        $format = strtolower($request->input('format') ?? 'csv');

        if ($format === 'pdf') {
            return view('admin.payments.print', compact('payments'));
        }

        $filename = "payments_export_" . date('Ymd_His') . ($format === 'excel' ? '.xls' : '.csv');
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Output CSV column headers
        fputcsv($output, ['S.No', 'Payment Date', 'Member ID', 'Name', 'Plan', 'Amount', 'Payment Method', 'Status']);
        
        foreach ($payments as $index => $payment) {
            fputcsv($output, [
                $index + 1,
                date('d M Y', strtotime($payment->payment_date)),
                $payment->userid,
                $payment->name,
                $payment->plan_name ?? 'N/A',
                '₹' . number_format($payment->amount, 2),
                $payment->payment_method,
                $payment->status ?? 'Pending'
            ]);
        }
        
        fclose($output);
        exit;
    }

    /**
     * Delete a premium plan.
     */
    public function deletePlan($id)
    {
        $plan = DB::table('plans')->where('id', $id)->first();
        if (!$plan) {
            return back()->with('error', 'Plan not found.');
        }

        DB::table('plans')->where('id', $id)->delete();
        return redirect()->route('admin.plans')->with('success', 'Plan deleted successfully.');
    }
}
