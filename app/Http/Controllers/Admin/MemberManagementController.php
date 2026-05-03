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
        
        // Branch filtering for mediators/staff
        if (session('role') === 'mediator') {
            $query->where('branch_id', auth()->user()->branch_id);
        }
        
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
        
        if (session('role') === 'mediator') {
            $query->where('branch_id', auth()->user()->branch_id);
        }

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
        
        if (session('role') === 'mediator') {
            $query->where('branch_id', auth()->user()->branch_id);
        }

        if ($request->gender) $query->where('gender', $request->gender);
        $members = $query->orderBy('id', 'desc')->paginate(50);
        return view('admin.members.list', compact('members'), ['title' => 'Free Members']);
    }

    /**
     * Deleted members list
     */
    public function deletedMembers()
    {
        $query = User::where('status', 3);
        if (session('role') === 'mediator') {
            $query->where('branch_id', auth()->user()->branch_id);
        }
        $members = $query->orderBy('id', 'desc')->paginate(50);
        return view('admin.members.list', compact('members'), ['title' => 'Deleted Members']);
    }

    /**
     * Pending approval members
     */
    public function pendingMembers()
    {
        $query = User::where('status', 0);
        if (session('role') === 'mediator') {
            $query->where('branch_id', auth()->user()->branch_id);
        }
        $members = $query->orderBy('id', 'desc')->paginate(50);
        return view('admin.members.list', compact('members'), ['title' => 'Member Approval - Pending']);
    }

    /**
     * View a specific member's profile
     */
    public function viewMember($id)
    {
        $member = User::findOrFail($id);
        
        // Security check for mediators
        if (session('role') === 'mediator' && $member->branch_id != auth()->user()->branch_id) {
            abort(403, 'Unauthorized access to this member.');
        }

        $images  = DB::table('profile_images')->where('userid', $id)->get();
        return view('admin.members.view', compact('member', 'images'));
    }

    /**
     * Approve a member
     */
    public function approveMember($id)
    {
        $member = User::findOrFail($id);
        if (session('role') === 'mediator' && $member->branch_id != auth()->user()->branch_id) {
            abort(403);
        }
        $member->update(['status' => 1]);
        return back()->with('success', 'Member approved successfully.');
    }

    /**
     * Suspend a member
     */
    public function suspendMember($id)
    {
        $member = User::findOrFail($id);
        if (session('role') === 'mediator' && $member->branch_id != auth()->user()->branch_id) {
            abort(403);
        }
        $member->update(['status' => 2]);
        return back()->with('success', 'Member suspended.');
    }

    /**
     * Delete a member
     */
    public function deleteMember($id)
    {
        $member = User::findOrFail($id);
        if (session('role') === 'mediator' && $member->branch_id != auth()->user()->branch_id) {
            abort(403);
        }
        $member->update(['status' => 3]);
        return back()->with('success', 'Member deleted.');
    }

    /**
     * Show create member form
     */
    public function createMember()
    {
        $onbehalfs = DB::table('onbehalf')->get();
        $religions = DB::table('religion')->get();
        $marital_statuses = DB::table('marital_status')->get();
        $educations = DB::table('education')->get();
        $employments = DB::table('employment')->get();
        $occupations = DB::table('occupation')->get();
        $heights = DB::table('height')->get();
        $raasis = DB::table('raasi')->get();
        $stars = DB::table('star')->get();

        return view('admin.members.create', compact(
            'onbehalfs', 'religions', 'marital_statuses', 
            'educations', 'employments', 'occupations', 
            'heights', 'raasis', 'stars'
        ), ['title' => 'Add New Member']);
    }

    /**
     * Store new member
     */
    public function storeMember(Request $request)
    {
        // Add branch_id to request if mediator
        if (session('role') === 'mediator') {
            $request->merge(['branch_id' => auth()->user()->branch_id]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:free_user,emailid',
            'mobileno' => 'required|digits:10|unique:free_user,mobileno',
            'gender' => 'required|in:Male,Female',
            'onbehalf' => 'required|exists:onbehalf,id',
            'password' => 'required|string|min:6',
            'date_of_birth' => 'required|date',
            'maritalstatus' => 'required|string',
            'religion' => 'required|exists:religion,id',
            'branch_id' => 'nullable|exists:temple_branches,id',
        ]);

        // Generate unique IDs
        $register_id = User::generateRegisterId();
        $mid = User::generateMid($request->gender);
        $userid = User::generateUserId();

        // Calculate age from DOB
        $dob = new \DateTime($request->date_of_birth);
        $now = new \DateTime();
        $age = $now->diff($dob)->y;

        // Basic user creation
        $user = User::create([
            'name' => $request->name,
            'emailid' => $request->email,
            'mobileno' => $request->mobileno,
            'gender' => $request->gender,
            'password' => bcrypt($request->password), 
            'register_id' => $register_id,
            'mid' => $mid,
            'userid' => $userid,
            'onbehalf' => $request->onbehalf,
            'maritalstatus' => $request->maritalstatus,
            'religion' => $request->religion,
            'status' => 1,
            'date' => date('Y-m-d'),
            'role' => 'customer',
            'branch_id' => $request->branch_id,
            'date_of_birth' => $request->date_of_birth,
            'age' => $age,
        ]);

        return redirect()->route('admin.members.all')->with('success', 'Member created successfully.');
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
            ->select('profile_images.*', 'profile_images.image_name as image', 'free_user.userid as m_userid', 'free_user.name')
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
            ->select('jathagam_images.*', 'jathagam_images.image_name as image', 'free_user.userid as m_userid', 'free_user.name')
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
