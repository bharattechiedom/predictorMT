<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Company;
use App\Models\Demo;
use App\Models\Payment;
use App\Models\Subscription;

class UserController extends Controller
{
    /**
     * Show the user login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        return view('signin');
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        // If OTP is provided, verify it
        if ($request->has('otp')) {
            return $this->verifyLoginOtp($request);
        }
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|min:6',
        ]);

        // Check if user exists by phone
        $user = User::where('phone', $request->phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'phone' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('phone'));
        }

        // Store credentials and show OTP prompt (static OTP flow)
        $request->session()->put([
            'login_pending' => true,
            'login_phone' => $request->phone,
            'login_password' => $request->password,
            'login_remember' => $request->has('remember'),
        ]);

        return redirect()->route('signin')->with('show_otp', true)->withInput(['phone' => $request->phone]);
    }

    /**
     * Verify login OTP
     */
    private function verifyLoginOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:4',
        ]);

        if ($request->session()->get('login_pending') !== true) {
            return redirect()->route('signin')->withErrors(['otp' => 'Invalid OTP session.']);
        }

        // Static OTP verification (1234)
        if ($request->otp !== '1234') {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.'])->with('show_otp', true)->withInput();
        }

        // OTP verified - complete login
        $phone = $request->session()->get('login_phone');
        $user = User::where('phone', $phone)->first();

        Auth::login($user, $request->session()->get('login_remember'));
        $request->session()->forget(['login_pending', 'login_phone', 'login_password', 'login_remember']);
        $request->session()->regenerate();

        return redirect()->intended(route('user.dashboard'))->with('success', 'Welcome back!');
    }

    /**
     * Show the user registration form
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        // No payment processing here: show simple signup form
        return view('signup');
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        // If OTP is provided, verify it
        if ($request->has('otp')) {
            return $this->verifyRegisterOtp($request);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone',
            'email' => 'required|string|unique:users,email|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Store data and show OTP prompt (static OTP)
        $request->session()->put([
            'register_pending' => true,
            'register_name' => $request->name,
            'register_email' => $request->email,
            'register_phone' => $request->phone,
            'register_password' => $request->password,
            'register_password_confirmation' => $request->password_confirmation,
            'register_plan_id' => $request->input('plan_id'),
            'register_stripe_session' => $request->input('stripe_session_id'),
        ]);

        return redirect()->route('signup')->with('show_otp', true)->withInput($request->only('name', 'phone','email'));
    }

    /**
     * Verify registration OTP
     */
    private function verifyRegisterOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:4',
        ]);

        if ($request->session()->get('register_pending') !== true) {
            return redirect()->route('signup')->withErrors(['otp' => 'Invalid OTP session.']);
        }

        // Static OTP verification (1234)
        if ($request->otp !== '1234') {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.'])->with('show_otp', true)->withInput();
        }

        // OTP verified - complete registration
        $name = $request->session()->get('register_name');
        $phone = $request->session()->get('register_phone');
        $email = $request->session()->get('register_email');
        $password = $request->session()->get('register_password');

        // Create company (store phone for company contact)
        $company = Company::firstOrCreate(
            ['name' => $name . "'s Company"],
            ['address' => '', 'phone' => $phone, 'email' => $email]
        );

        // Create user
        $user = User::create([
            'company_id' => $company->id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => Hash::make($password),
            'role' => 'viewer',
        ]);

        $request->session()->forget(['register_pending', 'register_name', 'register_phone', 'register_email', 'register_password', 'register_password_confirmation']);

        Auth::login($user);
        $request->session()->regenerate();

        // Clean registration plan/session entries (no payment verification here)
        $request->session()->forget(['register_plan_id','register_stripe_session']);

        return redirect()->route('user.dashboard')->with('success', 'Registration successful! Welcome to PredictorMT.');
    }

    /**
     * Show user dashboard
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('signin')->with('error', 'Please login to access your dashboard.');
        }

        $user = Auth::user();
        // Load recent payments for this user (match by customer email)
        $payments = [];
        try {
            if ($user->email) {
                $payments = Payment::with('plan')->where('customer_email', $user->email)->orderBy('created_at', 'desc')->get();
            }
        } catch (\Exception $e) {
            logger()->warning('Payments load error: ' . $e->getMessage());
            $payments = collect();
        }

        // Load subscriptions for the user's company
        $subscriptions = collect();
        try {
            if ($user->company_id) {
                $subscriptions = Subscription::with('plan')->where('company_id', $user->company_id)->orderBy('started_at', 'desc')->get();
            }
        } catch (\Exception $e) {
            logger()->warning('Subscriptions load error: ' . $e->getMessage());
            $subscriptions = collect();
        }

        return view('user.index', compact('user', 'payments', 'subscriptions'));
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
    /**
     * Handle demo request submission
     */
    public function submitDemoRequest(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'preferred_date' => 'required|date',
        ]);

        $demo = new Demo();
        $demo->first_name = $request->first_name;
        $demo->last_name = $request->last_name;
        $demo->email = $request->email;
        $demo->phone = $request->phone;
        $demo->company_name = $request->company_name;
        $demo->preferred_date = $request->preferred_date;
        $demo->additional_notes = $request->additional_notes;
        $demo->save();

        // Here you can handle the demo request, e.g., save to database or send email
        // For demonstration, we'll just return a success message

        return redirect()->back()->with('success', 'Your demo request has been submitted successfully. We will contact you soon!');
    }
}

