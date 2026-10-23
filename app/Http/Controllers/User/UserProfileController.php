<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserProfileController extends Controller
{
    /**
     * Show user profile page
     */
    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('signin')->with('error', 'Please login to access your profile.');
        }

        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('signin')->with('error', 'Please login to update your profile.');
        }

        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
            'password_confirmation' => 'same:password',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update user data
        $user->name = $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->state = $request->state;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
