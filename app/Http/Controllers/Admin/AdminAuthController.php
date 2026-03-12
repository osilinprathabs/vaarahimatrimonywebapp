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

    // Update admin password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = DB::table('admin')->where('admin_id', session('admin_id'))->first();

        if ($admin && $admin->password === $request->current_password) {
            DB::table('admin')->where('admin_id', session('admin_id'))->update([
                'user_id' => $request->username,
                'password' => $request->new_password
            ]);
            
            session(['admin_username' => $request->username]);
            
            return back()->with('success', 'Profile updated successfully.');
        }

        return back()->with('error', 'Current password does not match.');
    }
}
