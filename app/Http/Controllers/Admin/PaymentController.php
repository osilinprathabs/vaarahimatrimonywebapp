<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class PaymentController extends Controller
{ 
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        $payments = DB::table('payments')
            ->leftJoin('free_user', 'payments.member_id', '=', 'free_user.id')
            ->select('payments.*', 'free_user.name', 'free_user.gender', 'free_user.mobileno', 'free_user.userid')
            ->orderBy('payments.id', 'desc')
            ->paginate(50);
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
        DB::table('plans')->insert($data);

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
}
