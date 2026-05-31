<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Interest;
use App\Models\ContactAccessLog;
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
        
        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        if ($request->status !== null && $request->status !== '') {
            // Get all plan-expired and registration-expired IDs
            $planExpiredIds = DB::table('plan_assign')
                ->where('plan_status', 'Expired')
                ->pluck('member_id');

            $settings = DB::table('profile_ex_status')->first();
            $expiredUserIds = collect();

            if ($settings && $settings->expire_status && $settings->count) {
                $unit = $settings->expire_status; // date, month, year
                $count = $settings->count;
                
                $cutoffDate = now();
                if ($unit == 'date') $cutoffDate->subDays($count);
                elseif ($unit == 'month') $cutoffDate->subMonths($count);
                elseif ($unit == 'year') $cutoffDate->subYears($count);

                $expiredUserIds = User::where('date', '<', $cutoffDate->toDateString())
                    ->where('status', 1)
                    ->pluck('id');
            }

            $allExpiredIds = $planExpiredIds->merge($expiredUserIds)->unique();

            if ($request->status === 'active' || $request->status === '1') {
                // Approved accounts (status = 1) that are NOT expired
                $query->where('status', 1)->whereNotIn('id', $allExpiredIds);
            } elseif ($request->status === 'expired') {
                // Approved accounts that are expired
                $query->whereIn('id', $allExpiredIds);
            } elseif ($request->status === 'inactive' || $request->status === '0') {
                // Pending (status = 0) or suspended (status = 2) accounts
                $query->where(function($q) {
                    $q->where('status', 0)->orWhere('status', 2);
                });
            }
        }
        
        $members = $query->orderBy('id', 'desc')->paginate(25);
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
        $members = $query->orderBy('id', 'desc')->paginate(25);
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
        $members = $query->orderBy('id', 'desc')->paginate(25);
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
        $members = $query->orderBy('id', 'desc')->paginate(25);
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
        $members = $query->orderBy('id', 'desc')->paginate(25);
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
            ->paginate(25);

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
            ->paginate(25);
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
            ->paginate(25);
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

    /**
     * Export members list to CSV, Excel, or PDF print.
     */
    public function exportMembers(Request $request)
    {
        $query = User::query();
        
        if ($request->list_type === 'expired') {
            $planExpiredIds = DB::table('plan_assign')
                ->where('plan_status', 'Expired')
                ->pluck('member_id');

            $settings = DB::table('profile_ex_status')->first();
            $expiredUserIds = collect();

            if ($settings && $settings->expire_status && $settings->count) {
                $unit = $settings->expire_status;
                $count = $settings->count;
                
                $cutoffDate = now();
                if ($unit == 'date') $cutoffDate->subDays($count);
                elseif ($unit == 'month') $cutoffDate->subMonths($count);
                elseif ($unit == 'year') $cutoffDate->subYears($count);

                $expiredUserIds = User::where('date', '<', $cutoffDate->toDateString())
                    ->where('status', 1)
                    ->pluck('id');
            }

            $allExpiredIds = $planExpiredIds->merge($expiredUserIds)->unique();
            $query->whereIn('id', $allExpiredIds);
        }
        
        if (session('role') === 'mediator') {
            $query->where('branch_id', auth()->user()->branch_id);
        }
        
        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        if ($request->status !== null && $request->status !== '') {
            $planExpiredIds = DB::table('plan_assign')
                ->where('plan_status', 'Expired')
                ->pluck('member_id');

            $settings = DB::table('profile_ex_status')->first();
            $expiredUserIds = collect();

            if ($settings && $settings->expire_status && $settings->count) {
                $unit = $settings->expire_status;
                $count = $settings->count;
                
                $cutoffDate = now();
                if ($unit == 'date') $cutoffDate->subDays($count);
                elseif ($unit == 'month') $cutoffDate->subMonths($count);
                elseif ($unit == 'year') $cutoffDate->subYears($count);

                $expiredUserIds = User::where('date', '<', $cutoffDate->toDateString())
                    ->where('status', 1)
                    ->pluck('id');
            }

            $allExpiredIds = $planExpiredIds->merge($expiredUserIds)->unique();

            if ($request->status === 'active' || $request->status === '1') {
                $query->where('status', 1)->whereNotIn('id', $allExpiredIds);
            } elseif ($request->status === 'expired') {
                $query->whereIn('id', $allExpiredIds);
            } elseif ($request->status === 'inactive' || $request->status === '0') {
                $query->where(function($q) {
                    $q->where('status', 0)->orWhere('status', 2);
                });
            }
        }

        // Fetch all matching records without pagination for full export
        $members = $query->orderBy('id', 'desc')->get();

        $format = strtolower($request->input('format') ?? 'csv');

        if ($format === 'pdf') {
            return view('admin.members.print', compact('members'));
        }

        // CSV/Excel stream
        $filename = "members_export_" . date('Ymd_His') . ($format === 'excel' ? '.xls' : '.csv');
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Output CSV column headers
        fputcsv($output, ['S.No', 'Member ID', 'Name', 'Gender', 'Mobile No', 'Email', 'Plan', 'Registration Date', 'Status']);
        
        foreach ($members as $index => $member) {
            $statusText = 'Pending';
            if ($member->status == 1) $statusText = 'Active';
            elseif ($member->status == 2) $statusText = 'Suspended';
            elseif ($member->status == 3) $statusText = 'Deleted';

            fputcsv($output, [
                $index + 1,
                $member->userid,
                $member->name,
                $member->gender,
                $member->mobileno,
                $member->email,
                $member->plan ?? 'Free',
                $member->date,
                $statusText
            ]);
        }
        
        fclose($output);
        exit;
    }

    /**
     * Admin Interest Management
     */
    public function allInterests(Request $request, $status = null)
    {
        $query = Interest::with(['sender', 'receiver']);

        // Handle specific status submenus
        if ($status && in_array(ucfirst($status), ['Pending', 'Accepted', 'Rejected', 'Withdrawn'])) {
            $query->where('status', ucfirst($status));
        }

        // Global search filtering if search term provided
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('sender', function($sq) use ($search) {
                    $sq->where('name', 'like', "%$search%")->orWhere('userid', 'like', "%$search%");
                })->orWhereHas('receiver', function($rq) use ($search) {
                    $rq->where('name', 'like', "%$search%")->orWhere('userid', 'like', "%$search%");
                });
            });
        }

        // If export parameter is present, stream CSV directly
        if ($request->filled('export')) {
            $interests = $query->orderBy('id', 'desc')->get();
            $filename = "interests_export_" . date('Ymd_His') . ".csv";
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Interest ID', 'Sender MID', 'Sender Name', 'Receiver MID', 'Receiver Name', 'Plan Name', 'Consumed Credit', 'Status', 'Date']);
            foreach ($interests as $item) {
                fputcsv($output, [
                    'INT' . sprintf('%04d', $item->id),
                    $item->sender->userid ?? 'N/A',
                    $item->sender->name ?? 'N/A',
                    $item->receiver->userid ?? 'N/A',
                    $item->receiver->name ?? 'N/A',
                    $item->plan_name ?? 'Free',
                    $item->consumed_interests,
                    $item->status,
                    $item->created_at
                ]);
            }
            fclose($output);
            exit;
        }

        $interests = $query->orderBy('id', 'desc')->paginate(25);

        // Calculate Interest Statistics
        $stats = [
            'total' => Interest::count(),
            'pending' => Interest::where('status', 'Pending')->count(),
            'accepted' => Interest::where('status', 'Accepted')->count(),
            'rejected' => Interest::where('status', 'Rejected')->count(),
            'withdrawn' => Interest::where('status', 'Withdrawn')->count(),
        ];

        return view('admin.interests.index', compact('interests', 'stats', 'status'));
    }

    /**
     * Admin Contact Access Logs
     */
    public function contactAccessLogs(Request $request)
    {
        $query = ContactAccessLog::with(['viewer', 'profileOwner']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('viewer', function($vq) use ($search) {
                    $vq->where('name', 'like', "%$search%")->orWhere('userid', 'like', "%$search%");
                })->orWhereHas('profileOwner', function($pq) use ($search) {
                    $pq->where('name', 'like', "%$search%")->orWhere('userid', 'like', "%$search%");
                });
            });
        }

        // If export parameter is present, stream CSV directly
        if ($request->filled('export')) {
            $logs = $query->orderBy('id', 'desc')->get();
            $filename = "contact_access_logs_" . date('Ymd_His') . ".csv";
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $output = fopen('php://output', 'w');
            fputcsv($output, ['S.No', 'Viewer MID', 'Viewer Name', 'Owner MID', 'Owner Name', 'Interest ID', 'Mobile Revealed', 'Email Revealed', 'Viewed Time']);
            foreach ($logs as $index => $log) {
                fputcsv($output, [
                    $index + 1,
                    $log->viewer->userid ?? 'N/A',
                    $log->viewer->name ?? 'N/A',
                    $log->profileOwner->userid ?? 'N/A',
                    $log->profileOwner->name ?? 'N/A',
                    'INT' . sprintf('%04d', $log->interest_id),
                    $log->mobile_viewed ?? 'N/A',
                    $log->email_viewed ?? 'N/A',
                    $log->viewed_time
                ]);
            }
            fclose($output);
            exit;
        }

        $logs = $query->orderBy('id', 'desc')->paginate(25);

        return view('admin.interests.contact_logs', compact('logs'));
    }
}
