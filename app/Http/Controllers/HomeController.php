<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
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

        $premium_matches = User::where('gender', $targetGender)
            ->where('status', 1)
            ->limit(6)
            ->get();

        $new_matches = User::where('gender', $targetGender)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();

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
        
        // Load related info
        $data = [
            'user' => $user,
            'targetUser' => $targetUser,
            'caste' => \App\Models\Caste::find($targetUser->caste),
            'subcaste' => \App\Models\Subcaste::where('subcaste', $targetUser->subcaste)->first(),
            'raasi' => \App\Models\Raasi::find($targetUser->raasi),
            'star' => \App\Models\Star::where('star', $targetUser->star)->first(),
            'dosham' => \App\Models\Dosham::find($targetUser->dhosam_type),
            'city' => \App\Models\City::find($targetUser->city),
            'state' => \App\Models\State::find($targetUser->state),
            'country' => \App\Models\Country::where('countryid', $targetUser->country)->first(),
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

    public function privacyPolicy()
    {
        return view('privacy_policy');
    }

    public function terms()
    {
        return view('terms');
    }
}
