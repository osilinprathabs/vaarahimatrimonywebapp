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
        $onbehalfs = \App\Models\Onbehalf::orderBy('onbehalf', 'asc')->get();
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
            if ($request->caste) {
                $query->where('caste', $request->caste);
            }
            if ($request->education) {
                $query->where('education', $request->education);
            }
            if ($request->monthly_income) {
                $query->where('currency_value', $request->monthly_income);
            }

            $results = $query->limit(20)->get();
            return view('search.results', compact('user', 'results'));
        }

        $data = [
            'user' => $user,
            'marital_statuses' => \App\Models\MaritalStatus::orderBy('marital_status', 'asc')->get(),
            'stars' => \App\Models\Star::orderBy('name', 'asc')->get(),
            'doshams' => \App\Models\Dosham::where('status', 1)->orderBy('dosham', 'asc')->get(),
            'castes' => \App\Models\Caste::where('status', 1)->orderBy('caste', 'asc')->get(),
            'educations' => \App\Models\Education::orderBy('education', 'asc')->get(),
            'currency_values' => \App\Models\CurrencyValue::all(),
        ];
        return view('search.advanced', $data);
    }

    public function myMatches(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $targetGender = ($user->gender == 'Male') ? 'Female' : 'Male';
        $query = User::where('gender', $targetGender)->where('status', 1);

        $hasPreferences = false;

        if ($user->expected_min_age) {
            $query->where('age', '>=', $user->expected_min_age);
            $hasPreferences = true;
        }
        if ($user->expected_max_age) {
            $query->where('age', '<=', $user->expected_max_age);
            $hasPreferences = true;
        }
        if ($user->expected_marital_status) {
            $query->where('maritalstatus', $user->expected_marital_status);
            $hasPreferences = true;
        }
        if ($user->expected_caste) {
            $query->where('caste', $user->expected_caste);
            $hasPreferences = true;
        }
        if ($user->expected_education) {
            $query->where('education', $user->expected_education);
            $hasPreferences = true;
        }
        if ($user->expected_monthly_income) {
            $query->where('currency_value', $user->expected_monthly_income);
            $hasPreferences = true;
        }
        if ($user->expected_raasi) {
            $query->where('raasi', $user->expected_raasi);
            $hasPreferences = true;
        }
        if ($user->expected_star) {
            $query->where('star', $user->expected_star);
            $hasPreferences = true;
        }

        $results = $query->orderBy('id', 'desc')->limit(50)->get();

        return view('search.matches', compact('user', 'results', 'hasPreferences'));
    }

    public function profileView($id)
    {
        $user = auth()->user();
        $targetUser = User::findOrFail($id);
        
        // 1. Enforce Gender Matching Security Rule (Admin can view all)
        if ($user && $user->role !== 'admin' && $user->gender == $targetUser->gender) {
            return redirect()->route('dashboard')->with('error', 'You cannot view profiles of the same gender.');
        }

        // Check if there is an interest sent or received between them (if logged in)
        $interest = null;
        if ($user) {
            $interest = \App\Models\Interest::where(function($q) use ($user, $targetUser) {
                $q->where('from_member_id', $user->id)->where('to_member_id', $targetUser->id);
            })->orWhere(function($q) use ($user, $targetUser) {
                $q->where('from_member_id', $targetUser->id)->where('to_member_id', $user->id);
            })->first();
        }
        
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
