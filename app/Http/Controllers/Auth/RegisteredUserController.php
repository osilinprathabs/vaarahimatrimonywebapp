<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:free_user,emailid'],
            'password' => ['required', 'string'], // No 'confirmed' in home form, keep it simple for now or adjust
            'mobileno' => ['required', 'string', 'max:10', 'unique:free_user,mobileno'],
            'onbehalf' => ['required'],
            'gender' => ['required'],
        ]);

        $user = User::create([
            'userid' => User::generateUserId(),
            'name' => $request->name,
            'emailid' => $request->email,
            'password' => $request->password, // Plain text for now as per legacy
            'mobileno' => $request->mobileno,
            'onbehalf' => $request->onbehalf,
            'gender' => $request->gender,
            'status' => 1,
            'date' => date('Y-m-d'),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('register.details');
    }
}
