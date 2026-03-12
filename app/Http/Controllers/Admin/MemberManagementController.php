<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class MemberManagementController extends Controller
{
    /**
     * All members list
     */
    public function allMembers(Request $request)
    {
        $query = User::query();
        if ($request->gender) $query->where('gender', $request->gender);
        if ($request->status !== null && $request->status !== '') $query->where('status', $request->status);
        $members = $query->orderBy('id', 'desc')->paginate(50);
        return view('admin.members.list', compact('members'), ['title' => 'All Members', 'show_add' => true]);
    }

    /**
     * Premium members list
     */
    public function premiumMembers(Request $request)
    {
        $query = User::whereNotNull('plan')->where('plan', '!=', '')->where('plan', '!=', 'Free');
        if ($request->gender) $query->where('gender', $request->gender);
        $members = $query->orderBy('id', 'desc')->paginate(50);
        return view('admin.members.list', compact('members'), ['title' => 'Premium Members']);
    }

    /**
     * Free members list
     */
    public function freeMembers(Request $request)
    {
        $query = User::where(function($q) {
            $q->whereNull('plan')->orWhere('plan', '')->orWhere('plan', 'Free');
        })->where('status', '!=', 3);
        if ($request->gender) $query->where('gender', $request->gender);
        $members = $query->orderBy('id', 'desc')->paginate(50);
        return view('admin.members.list', compact('members'), ['title' => 'Free Members']);
    }

    /**
     * Deleted members list
     */
    public function deletedMembers()
    {
        $members = User::where('status', 3)->orderBy('id', 'desc')->paginate(50);
        return view('admin.members.list', compact('members'), ['title' => 'Deleted Members']);
    }

    /**
     * Pending approval members
     */
    public function pendingMembers()
    {
        $members = User::where('status', 0)->orderBy('id', 'desc')->paginate(50);
        return view('admin.members.list', compact('members'), ['title' => 'Member Approval - Pending']);
    }

    /**
     * View a specific member's profile
     */
    public function viewMember($id)
    {
        $member = User::findOrFail($id);
        $images  = DB::table('profile_images')->where('userid', $id)->get();
        return view('admin.members.view', compact('member', 'images'));
    }

    /**
     * Approve a member
     */
    public function approveMember($id)
    {
        User::where('id', $id)->update(['status' => 1]);
        return back()->with('success', 'Member approved successfully.');
    }

    /**
     * Suspend a member
     */
    public function suspendMember($id)
    {
        User::where('id', $id)->update(['status' => 2]);
        return back()->with('success', 'Member suspended.');
    }

    /**
     * Delete a member
     */
    public function deleteMember($id)
    {
        User::where('id', $id)->update(['status' => 3]);
        return back()->with('success', 'Member deleted.');
    }

    /**
     * Expired members list
     */
    public function expiredList()
    {
        // 1. Get plan-expired members (legacy logic, keep it if data exists)
        $planExpiredIds = DB::table('plan_assign')
            ->where('plan_status', 'Expired')
            ->pluck('member_id');

        // 2. Get generally expired members based on settings
        $settings = DB::table('profile_ex_status')->first();
        $expiredUserIds = collect();

        if ($settings && $settings->expire_status && $settings->count) {
            $unit = $settings->expire_status; // date, month, year
            $count = $settings->count;
            
            // Sub days/months/years from now to find the cutoff registration date
            $cutoffDate = now();
            if ($unit == 'date') $cutoffDate->subDays($count);
            elseif ($unit == 'month') $cutoffDate->subMonths($count);
            elseif ($unit == 'year') $cutoffDate->subYears($count);

            $expiredUserIds = User::where('date', '<', $cutoffDate->toDateString())
                ->where('status', 1)
                ->pluck('id');
        }

        $allExpiredIds = $planExpiredIds->merge($expiredUserIds)->unique();

        $members = User::whereIn('id', $allExpiredIds)
            ->orderBy('id', 'desc')
            ->paginate(50);

        return view('admin.members.expired', compact('members'));
    }

    /**
     * Photo Approval Queue
     */
    public function photoQueue()
    {
        $photos = DB::table('profile_images')
            ->join('free_user', 'profile_images.userid', '=', 'free_user.id')
            ->select('profile_images.*', 'free_user.userid as m_userid', 'free_user.name')
            ->orderBy('profile_images.status', 'asc')
            ->paginate(50);
        return view('admin.members.photo_queue', compact('photos'));
    }

    /**
     * Horoscope Approval Queue
     */
    public function horoscopeQueue()
    {
        $horoscopes = DB::table('jathagam_images')
            ->join('free_user', 'jathagam_images.userid', '=', 'free_user.id')
            ->select('jathagam_images.*', 'free_user.userid as m_userid', 'free_user.name')
            ->orderBy('jathagam_images.status', 'asc')
            ->paginate(50);
        return view('admin.members.horoscope_queue', compact('horoscopes'));
    }

    /**
     * Approve/Reject Photo
     */
    public function updatePhotoStatus(Request $request, $id)
    {
        DB::table('profile_images')->where('id', $id)->update(['status' => $request->status]);
        return back()->with('success', 'Photo status updated.');
    }

    /**
     * Approve/Reject Horoscope
     */
    public function updateHoroscopeStatus(Request $request, $id)
    {
        DB::table('jathagam_images')->where('id', $id)->update(['status' => $request->status]);
        return back()->with('success', 'Horoscope status updated.');
    }
}
