<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $onbehalfs = \App\Models\Onbehalf::all();
        return view('home', compact('onbehalfs'));
    }

    public function dashboard()
    {
        $user = auth()->user();
        $targetGender = ($user->gender == 'Male') ? 'Female' : 'Male';

        // 1. Newest Members: the latest registered active members
        $new_matches = User::where('gender', $targetGender)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();
            
        $new_matches_ids = $new_matches->pluck('id')->toArray();

        // 2. Premium Recommendations: members with active paid plans (ID is not 14)
        $premium_matches = User::where('gender', $targetGender)
            ->where('status', 1)
            ->whereHas('planAssign', function($query) {
                $query->where('plan_id', '!=', 14);
            })
            ->limit(6)
            ->get();

        // Fallback: If no actual premium matches exist in the system, show other active members
        // excluding the newest members to ensure the listings are always distinct!
        if ($premium_matches->isEmpty()) {
            $premium_matches = User::where('gender', $targetGender)
                ->where('status', 1)
                ->whereNotIn('id', $new_matches_ids)
                ->orderBy('id', 'asc')
                ->limit(6)
                ->get();
        }

        return view('dashboard', compact('user', 'premium_matches', 'new_matches'));
    }

    public function idSearch(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod('post')) {
            $mid = $request->mid;
            $targetGender = ($user->gender == 'Male') ? 'Female' : 'Male';
            $results = User::where('userid', $mid)
                ->where('gender', $targetGender)
                ->where('status', 1)
                ->get();
            
            return view('search.results', compact('user', 'results'));
        }
        return view('search.id', compact('user'));
    }

    public function advancedSearch(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod('post')) {
            $targetGender = ($user->gender == 'Male') ? 'Female' : 'Male';
            $query = User::where('gender', $targetGender)->where('status', 1);

            if ($request->min_age && $request->max_age) {
                $query->whereBetween('age', [$request->min_age, $request->max_age]);
            }
            if ($request->marital_status) {
                $query->where('maritalstatus', $request->marital_status);
            }
            // Add other filters as needed...

            $results = $query->limit(20)->get();
            return view('search.results', compact('user', 'results'));
        }

        $data = [
            'user' => $user,
            'marital_statuses' => \App\Models\MaritalStatus::all(),
            'stars' => \App\Models\Star::all(),
            'doshams' => \App\Models\Dosham::all(),
        ];
        return view('search.advanced', $data);
    }

    public function profileView($id)
    {
        $user = auth()->user();
        $targetUser = User::findOrFail($id);
        
        // 1. Enforce Gender Matching Security Rule (Admin can view all)
        if ($user && $user->role !== 'admin' && $user->gender == $targetUser->gender) {
            return redirect()->route('dashboard')->with('error', 'You cannot view profiles of the same gender.');
        }

        // Check if there is an interest sent or received between them
        $interest = \App\Models\Interest::where(function($q) use ($user, $targetUser) {
            $q->where('from_member_id', $user->id)->where('to_member_id', $targetUser->id);
        })->orWhere(function($q) use ($user, $targetUser) {
            $q->where('from_member_id', $targetUser->id)->where('to_member_id', $user->id);
        })->first();
        
        // Load related info
        $data = [
            'user' => $user,
            'targetUser' => $targetUser,
            'interest' => $interest,
            'religion' => \App\Models\Religion::find($targetUser->religion),
            'caste' => \App\Models\Caste::find($targetUser->caste),
            'subcaste' => \App\Models\Subcaste::find($targetUser->subcaste),
            'raasi' => \App\Models\Raasi::find($targetUser->raasi),
            'star' => \App\Models\Star::find($targetUser->star),
            'dosham' => \App\Models\Dosham::find($targetUser->dhosam_type),
            'city' => \App\Models\City::find($targetUser->city),
            'state' => \App\Models\State::find($targetUser->state),
            'country' => \App\Models\Country::where('countryid', $targetUser->country)->first(),
            'height' => \App\Models\Height::where('height', $targetUser->height)->first(),
            'horoscope' => \App\Models\MemberHoroscope::where('member_id', $targetUser->id)->first(),
        ];
        
        return view('search.profile', $data);
    }

    public function aboutUs()
    {
        return view('aboutus');
    }

    public function contactUs()
    {
        return view('contactus');
    }

    public function storeContactUs(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->only(['name', 'email', 'phone', 'subject', 'message']));

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }

    public function privacyPolicy()
    {
        return view('privacy_policy');
    }

    public function terms()
    {
        return view('terms');
    }
}
