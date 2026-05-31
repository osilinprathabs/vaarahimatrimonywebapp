<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\AadhaarImage;
use App\Models\Branch;
use App\Models\Caste;
use App\Models\City;
use App\Models\Country;
use App\Models\CurrencyValue;
use App\Models\Dosham;
use App\Models\Education;
use App\Models\Employment;
use App\Models\Gothram;
use App\Models\Height;
use App\Models\JathagamImage;
use App\Models\Laknam;
use App\Models\MaritalStatus;
use App\Models\MemberHoroscope;
use App\Models\Occupation;
use App\Models\Onbehalf;
use App\Models\ProfileImage;
use App\Models\Raasi;
use App\Models\Star;
use App\Models\State;
use App\Models\Subcaste;
use App\Models\User;
use App\Models\Interest;
use App\Models\ContactAccessLog;
use App\Models\PlanAssign;
use App\Models\Plan;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function createDetails(Request $request): View
    {
        $user = $request->user();
        
        $data = [
            'user' => $user,
            'onbehalfs' => Onbehalf::all(),
            'marital_statuses' => MaritalStatus::all(),
            'educations' => Education::all(),
            'employments' => Employment::all(),
            'occupations' => Occupation::all(),
            'currency_values' => CurrencyValue::all(),
            'countries' => Country::orderBy('position', 'desc')->get(),
            'heights' => Height::all(),
            'castes' => Caste::where('status', 1)->get(),
            'gotharams' => Gothram::all(),
            'raasis' => Raasi::where('status', 1)->get(),
            'doshams' => Dosham::where('status', 1)->get(),
        ];

        return view('auth.register_details', $data);
    }

    public function storeDetails(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        // Update User (free_user table)
        $userData = $request->except([
            '_token', 'profile_img', 'aadhaar', 'jathagam', 
            'raasi_1', 'raasi_2', 'raasi_3', 'raasi_4', 'raasi_5', 'raasi_6', 
            'raasi_7', 'raasi_8', 'raasi_9', 'raasi_10', 'raasi_11', 'raasi_12', 
            'amsam_1', 'amsam_2', 'amsam_3', 'amsam_4', 'amsam_5', 'amsam_6', 
            'amsam_7', 'amsam_8', 'amsam_9', 'amsam_10', 'amsam_11', 'amsam_12'
        ]);
        
        // Map dob to date_of_birth and calculate age
        if ($request->has('dob')) {
            $userData['date_of_birth'] = $request->dob;
            $userData['age'] = \Carbon\Carbon::parse($request->dob)->age;
            unset($userData['dob']);
        }

        // Map indian_currency_value to currency_value
        if ($request->has('indian_currency_value')) {
            $userData['currency_value'] = $request->indian_currency_value;
            unset($userData['indian_currency_value']);
        }

        // Handle physical status mapping if needed
        if ($request->has('disability')) {
            $userData['disability'] = $request->disability;
        }

        $user->update($userData);

        // Handle File Uploads
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $path = $file->store('uploads/profile', 'public');
            ProfileImage::updateOrCreate(
                ['userid' => $user->id],
                [
                    'image_name'      => $path,
                    'status'          => 0,  // pending admin approval
                    'added_datetime'  => now(),
                ]
            );
        }

        if ($request->hasFile('aadhaar')) {
            $file = $request->file('aadhaar');
            $path = $file->store('uploads/aadhaar', 'public');
            AadhaarImage::updateOrCreate(
                ['userid' => $user->id],
                [
                    'image_name'     => $path,
                    'aadhaar_image'  => $path,
                    'status'         => 0,  // pending admin approval
                    'added_datetime' => now(),
                ]
            );
        }

        if ($request->hasFile('jathagam')) {
            $file = $request->file('jathagam');
            $path = $file->store('uploads/jathagam', 'public');
            JathagamImage::updateOrCreate(
                ['userid' => $user->id],   // userid is INT — must use $user->id
                [
                    'image_name'     => $path,
                    'status'         => 0,  // pending admin approval
                    'added_datetime' => now(),
                ]
            );
        }

        // Handle Horoscope Grid (raasi_1 to raasi_12 and amsam_1 to amsam_12)
        $horoscopeData = ['member_id' => $user->id];
        $hasHoroscopeData = false;
        
        for ($i = 1; $i <= 12; $i++) {
            $raasiKey = "raasi_$i";
            $amsamKey = "amsam_$i";
            
            if ($request->has($raasiKey)) {
                $horoscopeData["rasi_$i"] = is_array($request->$raasiKey) ? implode('||', $request->$raasiKey) : $request->$raasiKey;
                $hasHoroscopeData = true;
            }
            if ($request->has($amsamKey)) {
                $horoscopeData["amsam_$i"] = is_array($request->$amsamKey) ? implode('||', $request->$amsamKey) : $request->$amsamKey;
                $hasHoroscopeData = true;
            }
        }
        
        if ($hasHoroscopeData) {
            MemberHoroscope::updateOrCreate(
                ['member_id' => $user->id],
                $horoscopeData
            );
        }

        return redirect()->route('dashboard')->with('status', 'Registration completed successfully!');
    }

    /**
     * Upload / replace the logged-in member's profile photo.
     * Called from the dashboard camera-button modal.
     */
    public function uploadPhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_img' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $user = $request->user();

        $path = $request->file('profile_img')->store('uploads/profile', 'public');

        ProfileImage::updateOrCreate(
            ['userid' => $user->id],
            [
                'image_name'     => $path,
                'status'         => 0,   // pending admin approval
                'added_datetime' => now(),
            ]
        );

        return back()->with('photo_status', 'Your photo has been uploaded and is pending admin approval.');
    }


    // AJAX Handlers
    public function getStates($country_id)
    {
        return response()->json(State::where('countryid', $country_id)->get());
    }

    public function getCities($state_id)
    {
        return response()->json(City::where('stateid', $state_id)->get());
    }

    public function getSubcastes($caste_id)
    {
        return response()->json(Subcaste::where('caste', $caste_id)->get());
    }

    public function getGotharams($caste_id)
    {
        return response()->json(Gothram::where('caste', $caste_id)->get());
    }

    public function getStars($raasi_id)
    {
        return response()->json(Star::where('rashi', $raasi_id)->get());
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        
        $data = [
            'user' => $user,
            'onbehalfs' => Onbehalf::all(),
            'marital_statuses' => MaritalStatus::all(),
            'educations' => Education::all(),
            'employments' => Employment::all(),
            'occupations' => Occupation::all(),
            'currency_values' => CurrencyValue::all(),
            'countries' => Country::orderBy('position', 'desc')->get(),
            'heights' => Height::all(),
            'castes' => Caste::where('status', 1)->get(),
            'gotharams' => Gothram::all(),
            'raasis' => Raasi::where('status', 1)->get(),
            'doshams' => Dosham::where('status', 1)->get(),
            'subcastes' => $user->caste ? Subcaste::where('caste', $user->caste)->get() : collect(),
            'stars' => $user->raasi ? Star::where('rashi', $user->raasi)->get() : collect(),
            'horoscope' => MemberHoroscope::where('member_id', $user->id)->first(),
        ];

        return view('profile.edit', $data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        // Validate basic details
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'emailid' => ['required', 'string', 'email', 'max:255', 'unique:free_user,emailid,' . $user->id],
            'whatsapp_no' => ['required', 'string', 'max:15'],
            'dob' => ['required', 'date'],
            'birth_time' => ['required'],
            'birth_city' => ['required', 'string'],
            'maritalstatus' => ['required'],
            'education' => ['required'],
            'employment' => ['required'],
            'occupation' => ['required'],
            'indian_currency_value' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'caste' => ['required'],
            'subcaste' => ['required'],
            'raasi' => ['required'],
            'star' => ['required'],
            'address' => ['required', 'string'],
        ]);
        
        // Update User (free_user table)
        $userData = $request->except([
            '_token', '_method', 'profile_img', 'aadhaar', 'jathagam', 'current_password', 'new_password', 'new_password_confirmation',
            'raasi_1', 'raasi_2', 'raasi_3', 'raasi_4', 'raasi_5', 'raasi_6', 
            'raasi_7', 'raasi_8', 'raasi_9', 'raasi_10', 'raasi_11', 'raasi_12', 
            'amsam_1', 'amsam_2', 'amsam_3', 'amsam_4', 'amsam_5', 'amsam_6', 
            'amsam_7', 'amsam_8', 'amsam_9', 'amsam_10', 'amsam_11', 'amsam_12'
        ]);
        
        // Map dob to date_of_birth and calculate age
        if ($request->has('dob')) {
            $userData['date_of_birth'] = $request->dob;
            $userData['age'] = \Carbon\Carbon::parse($request->dob)->age;
            unset($userData['dob']);
        }

        // Map indian_currency_value to currency_value
        if ($request->has('indian_currency_value')) {
            $userData['currency_value'] = $request->indian_currency_value;
            unset($userData['indian_currency_value']);
        }

        $user->update($userData);

        // Handle File Uploads
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $path = $file->store('uploads/profile', 'public');
            ProfileImage::updateOrCreate(
                ['userid' => $user->id],
                [
                    'image_name'      => $path,
                    'status'          => 0,  // pending admin approval
                    'added_datetime'  => now(),
                ]
            );
        }

        if ($request->hasFile('aadhaar')) {
            $file = $request->file('aadhaar');
            $path = $file->store('uploads/aadhaar', 'public');
            AadhaarImage::updateOrCreate(
                ['userid' => $user->id],
                [
                    'image_name'     => $path,
                    'aadhaar_image'  => $path,
                    'status'         => 0,  // pending admin approval
                    'added_datetime' => now(),
                ]
            );
        }

        if ($request->hasFile('jathagam')) {
            $file = $request->file('jathagam');
            $path = $file->store('uploads/jathagam', 'public');
            JathagamImage::updateOrCreate(
                ['userid' => $user->id],
                [
                    'image_name'     => $path,
                    'status'         => 0,  // pending admin approval
                    'added_datetime' => now(),
                ]
            );
        }

        // Handle Horoscope Grid (raasi_1 to raasi_12 and amsam_1 to amsam_12)
        $horoscopeData = ['member_id' => $user->id];
        $hasHoroscopeData = false;
        
        for ($i = 1; $i <= 12; $i++) {
            $raasiKey = "raasi_$i";
            $amsamKey = "amsam_$i";
            
            if ($request->has($raasiKey)) {
                $horoscopeData["rasi_$i"] = is_array($request->$raasiKey) ? implode('||', $request->$raasiKey) : $request->$raasiKey;
                $hasHoroscopeData = true;
            } else {
                $horoscopeData["rasi_$i"] = null;
            }
            
            if ($request->has($amsamKey)) {
                $horoscopeData["amsam_$i"] = is_array($request->$amsamKey) ? implode('||', $request->$amsamKey) : $request->$amsamKey;
                $hasHoroscopeData = true;
            } else {
                $horoscopeData["amsam_$i"] = null;
            }
        }
        
        if ($hasHoroscopeData) {
            MemberHoroscope::updateOrCreate(
                ['member_id' => $user->id],
                $horoscopeData
            );
        }

        // Handle password change if filled
        if ($request->filled('current_password') && $request->filled('new_password')) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'new_password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
            
            $user->update([
                'password' => \Illuminate\Support\Facades\Hash::make($request->new_password),
                'temp_password' => null // Clear temp password once user updates
            ]);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Express interest in another member's profile.
     */
    public function sendInterest(Request $request, $id): RedirectResponse
    {
        $user = $request->user();
        $targetUser = User::findOrFail($id);

        if ($user->gender == $targetUser->gender) {
            return back()->with('error', 'You can only express interest to profiles of the opposite gender.');
        }

        // Check plan limits
        $planDetails = $user->getPlanDetails();
        $remaining = $planDetails->total_interests - $planDetails->used_interests;
        if ($remaining <= 0) {
            return back()->with('error', 'You have consumed your plan interest limit. Please upgrade your plan.');
        }

        // Check if interest already exists in active states
        $existing = Interest::where('from_member_id', $user->id)
            ->where('to_member_id', $targetUser->id)
            ->whereIn('status', ['Pending', 'Accepted'])
            ->first();

        if ($existing) {
            return back()->with('error', 'An active interest request already exists for this member.');
        }

        // Deduct 1 interest from plan balance
        $planDetails->increment('used_interests');

        // Create Interest Record
        $planModel = Plan::find($planDetails->plan_id);
        $interest = Interest::create([
            'from_member_id' => $user->id,
            'to_member_id' => $targetUser->id,
            'plan_id' => $planDetails->plan_id,
            'plan_name' => $planModel ? $planModel->name : 'Free',
            'consumed_interests' => 1,
            'status' => 'Pending',
        ]);

        // Create Notification for Target User
        Notification::create([
            'user_id' => $targetUser->id,
            'message' => 'You have received a new interest request from ' . $user->name . ' (' . $user->userid . ').',
        ]);

        return back()->with('success', 'Interest request sent successfully!');
    }

    /**
     * Accept a received interest request.
     */
    public function acceptInterest(Request $request, $id): RedirectResponse
    {
        $user = $request->user();
        $interest = Interest::where('to_member_id', $user->id)->where('id', $id)->firstOrFail();
        
        $interest->update(['status' => 'Accepted']);

        // Create Notification for Sender
        Notification::create([
            'user_id' => $interest->from_member_id,
            'message' => 'Your interest request to ' . $user->name . ' (' . $user->userid . ') has been accepted. Contact details are now available.',
        ]);

        return back()->with('success', 'Interest request accepted!');
    }

    /**
     * Reject a received interest request.
     */
    public function rejectInterest(Request $request, $id): RedirectResponse
    {
        $user = $request->user();
        $interest = Interest::where('to_member_id', $user->id)->where('id', $id)->firstOrFail();
        
        $interest->update(['status' => 'Rejected']);

        return back()->with('success', 'Interest request rejected.');
    }

    /**
     * Withdraw a sent interest request.
     */
    public function withdrawInterest(Request $request, $id): RedirectResponse
    {
        $user = $request->user();
        $interest = Interest::where('from_member_id', $user->id)->where('id', $id)->firstOrFail();
        
        // Only pending interests can refund consumed credits when withdrawn
        if ($interest->status === 'Pending') {
            $planAssign = $user->getPlanDetails();
            if ($planAssign && $planAssign->used_interests > 0) {
                // Safely decrement the used counter by the amount originally consumed
                $planAssign->decrement('used_interests', $interest->consumed_interests);
            }
        }
        
        $interest->update(['status' => 'Withdrawn']);

        return back()->with('success', 'Interest request withdrawn and interest credit has been refunded.');
    }

    /**
     * View customer interests menu page.
     */
    public function myInterests(Request $request): View
    {
        $user = $request->user();

        $sent = Interest::where('from_member_id', $user->id)->orderBy('id', 'desc')->get();
        $received = Interest::where('to_member_id', $user->id)->orderBy('id', 'desc')->get();
        $accepted = Interest::where(function($query) use ($user) {
            $query->where('from_member_id', $user->id)->orWhere('to_member_id', $user->id);
        })->where('status', 'Accepted')->orderBy('id', 'desc')->get();
        
        $rejected = Interest::where(function($query) use ($user) {
            $query->where('from_member_id', $user->id)->orWhere('to_member_id', $user->id);
        })->where('status', 'Rejected')->orderBy('id', 'desc')->get();

        return view('profile.my_interests', compact('user', 'sent', 'received', 'accepted', 'rejected'));
    }

    /**
     * Log contact access when a user views details.
     */
    public function logContactView(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|integer',
            'interest_id' => 'required|integer',
        ]);

        $viewer = $request->user();
        $profileOwner = User::findOrFail($request->profile_id);

        ContactAccessLog::create([
            'viewer_id' => $viewer->id,
            'profile_id' => $profileOwner->id,
            'interest_id' => $request->interest_id,
            'viewed_time' => now(),
            'mobile_viewed' => $profileOwner->mobileno,
            'email_viewed' => $profileOwner->emailid,
        ]);

        return response()->json(['success' => true]);
    }
}
