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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Note: In a real migration, we should add validation here matching the legacy fields
        $userData = $request->except(['_token', 'profile_img', 'aadhaar', 'passport', 'jathagam', 'raasi_1', 'raasi_2', 'raasi_3', 'raasi_4', 'raasi_5', 'raasi_6', 'raasi_7', 'raasi_8', 'raasi_9', 'raasi_10', 'raasi_11', 'raasi_12', 'amsam_1', 'amsam_2', 'amsam_3', 'amsam_4', 'amsam_5', 'amsam_6', 'amsam_7', 'amsam_8', 'amsam_9', 'amsam_10', 'amsam_11', 'amsam_12']);
        
        // Handle physical status mapping if needed
        if ($request->has('disability')) {
            $userData['disability'] = $request->disability;
        }

        $user->update($userData);

        // Handle File Uploads
        if ($request->hasFile('profile_img')) {
            $path = $request->file('profile_img')->store('uploads/profile', 'public');
            ProfileImage::create([
                'userid' => $user->userid,
                'image_name' => $path,
                'status' => 1
            ]);
        }

        if ($request->hasFile('aadhaar')) {
            $path = $request->file('aadhaar')->store('uploads/aadhaar', 'public');
            AadhaarImage::create([
                'userid' => $user->userid,
                'image_name' => $path,
                'status' => 1
            ]);
        }

        if ($request->hasFile('jathagam')) {
            $path = $request->file('jathagam')->store('uploads/jathagam', 'public');
            JathagamImage::create([
                'userid' => $user->userid,
                'image_name' => $path,
                'status' => 1
            ]);
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

        // Handle Assets (convert array to string if needed)
        if ($request->has('assets')) {
            $user->assets = implode(', ', $request->assets);
            $user->save();
        }

        return redirect()->route('dashboard')->with('status', 'Registration completed successfully!');
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
        return response()->json(Subcaste::where('caste_id', $caste_id)->get());
    }

    public function getGotharams($caste_id)
    {
        return response()->json(Gothram::where('caste', $caste_id)->get());
    }

    public function getStars($raasi_id)
    {
        return response()->json(Star::where('raasi_id', $raasi_id)->get());
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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
}
