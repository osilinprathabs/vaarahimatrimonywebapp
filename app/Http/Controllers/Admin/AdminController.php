<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Dosham;
use App\Models\Subcaste;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $query = User::query();
        $isMediator = session('role') === 'mediator';
        $branchId = auth()->user()->branch_id;

        if ($isMediator) {
            $query->where('branch_id', $branchId);
        }

        $profile_count = (clone $query)->count();
        $female_count  = (clone $query)->where('gender', 'Female')->count();
        $male_count    = (clone $query)->where('gender', 'Male')->count();
        $pending_count = (clone $query)->where('status', 0)->count();
        $premium_count = (clone $query)->whereNotNull('plan')->where('plan', '!=', '')->where('plan', '!=', 'Free')->count();
        $free_count    = (clone $query)->where(function($q) {
            $q->whereNull('plan')->orWhere('plan', '')->orWhere('plan', 'Free');
        })->count();

        $recent_members = (clone $query)->orderBy('id', 'desc')->limit(10)->get();

        // Expired count based on settings
        $expired_count = 0;
        $settings = DB::table('profile_ex_status')->first();
        if ($settings && $settings->expire_status && $settings->count) {
            $cutoffDate = now();
            if ($settings->expire_status == 'date') $cutoffDate->subDays($settings->count);
            elseif ($settings->expire_status == 'month') $cutoffDate->subMonths($settings->count);
            elseif ($settings->expire_status == 'year') $cutoffDate->subYears($settings->count);

            $expired_count = (clone $query)->where('date', '<', $cutoffDate->toDateString())
                ->where('status', 1)
                ->count();
        }

        return view('admin.dashboard', compact(
            'profile_count', 'female_count', 'male_count',
            'pending_count', 'premium_count', 'free_count', 'recent_members', 'expired_count'
        ));
    }

    /**
     * Basic search
     */
    public function basicSearch(Request $request)
    {
        $members = collect();
        $doshams  = DB::table('dosham')->get();
        $subcastes = DB::table('subcaste')->orderBy('subcaste')->get();

        if ($request->isMethod('post')) {
            $query = User::query();
            
            if (session('role') === 'mediator') {
                $query->where('branch_id', auth()->user()->branch_id);
            }

            if ($request->filled('name'))     $query->where('name', 'like', '%'.$request->name.'%');
            if ($request->filled('gender'))   $query->where('gender', $request->gender);
            if ($request->filled('mobileno')) $query->where('mobileno', $request->mobileno);
            if ($request->filled('userid'))   $query->where('userid', $request->userid);
            $members = $query->orderBy('id','desc')->paginate(50);
        }

        return view('admin.search.basic', compact('members', 'doshams', 'subcastes'));
    }

    /**
     * Settings page
     */
    public function settings()
    {
        $settings = DB::table('profile_ex_status')->first();
        return view('admin.settings', compact('settings'));
    }

    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        $data = [
            'expire_status' => $request->expire_status,
            'count' => $request->count,
        ];
        
        $settings = DB::table('profile_ex_status')->first();
        if ($settings) {
            DB::table('profile_ex_status')->where('id', $settings->id)->update($data);
        } else {
            DB::table('profile_ex_status')->insert($data);
        }
        return back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Clear application cache
     */
    public function clearCache()
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('optimize:clear');
            return back()->with('success', 'System cache cleared and optimized successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error clearing cache: ' . $e->getMessage());
        }
    }
}
