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
        $onbehalfs = \App\Models\Onbehalf::all();
        return view('auth.register', compact('onbehalfs'));
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
            'mobileno' => ['required', 'string', 'max:10', 'unique:free_user,mobileno'],
            'onbehalf' => ['required'],
            'gender' => ['required'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        if ($request->filled('password')) {
            $generatedPassword = $request->password;
        } else {
            // Generate password: first 4 letters of name + last 5 digits of mobile
            $namePart = str_replace(' ', '', substr($request->name, 0, 4));
            $mobilePart = substr($request->mobileno, -5);
            $generatedPassword = $namePart . $mobilePart;
        }

        $user = User::create([
            'userid' => User::generateUserId(),
            'register_id' => User::generateRegisterId(),
            'mid' => User::generateMid($request->gender),
            'name' => $request->name,
            'emailid' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($generatedPassword),
            'temp_password' => $generatedPassword, // Store temporarily to show user, or just pass to session
            'mobileno' => $request->mobileno,
            'onbehalf' => $request->onbehalf,
            'gender' => $request->gender,
            'status' => 1,
            'date' => date('Y-m-d'),
            'age' => 0,
            'date_of_birth' => '',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('register.details')->with('generated_password', $generatedPassword);
    }
}
