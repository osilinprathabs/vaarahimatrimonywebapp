<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    // Show admin login form
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    // Handle admin login submission
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check admin credentials from the 'admin' table in legacy DB
        $admin = DB::table('admin')
            ->where('user_id', $request->username)
            ->where('password', $request->password)
            ->first();

        if ($admin) {
            session([
                'admin_logged_in' => true,
                'admin_id'        => $admin->admin_id,
                'admin_username'  => $admin->user_id,
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid username or password.')->withInput();
    }

    // Handle admin logout
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_username']);
        return redirect()->route('admin.login');
    }

    // Show change password form
    public function showChangePassword()
    {
        return view('admin.auth.change_password');
    }

    // Update admin profile (username and/or password)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'current_password' => 'required',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $admin = DB::table('admin')->where('admin_id', session('admin_id'))->first();

        // Check current password
        if (!$admin || $admin->password !== $request->current_password) {
            return back()->with('error', 'Current password does not match.');
        }

        $updateData = [
            'user_id' => $request->username,
        ];

        // Only update password if a new one is provided
        if ($request->filled('new_password')) {
            $updateData['password'] = $request->new_password;
        }

        DB::table('admin')->where('admin_id', session('admin_id'))->update($updateData);
        
        session(['admin_username' => $request->username]);
        
        return back()->with('success', 'Profile updated successfully.');
    }
}
