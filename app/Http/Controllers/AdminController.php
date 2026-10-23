<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
 
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        
       
        // Check if user exists and is admin
        $admin = Admin::where('email', $credentials['email'])->first();
        
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // For now, allow any user to login as admin (you can modify this logic)
            // In production, you should check for specific admin privileges
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();
            
            return redirect()->intended('/admin/dashboard')->with('success', 'Welcome back, Admin!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/admin/login')->with('error', 'Please login to access admin area.');
        }

        $admin = Auth::guard('admin')->user();
        return view('admin.dashboard', compact('admin'));
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login')->with('success', 'You have been logged out successfully.');
    }
}
