<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use App\Mail\UserMail;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    
public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        $token = Str::random(60);

        $subscriber = Newsletter::create([
            'email' => $request->email,
            'token' => $token
        ]);

        $data = [
            'token' => $subscriber->token
        ];

        Mail::to($subscriber->email)->send(new UserMail($data));

        return response()->json([
            'status' => true,
            'message' => 'Thanks for subscribing! Please check your email.'
        ]);
    }

    public function unsubscribe($token)
    {
        $subscriber = Newsletter::where('token',$token)->firstOrFail();
        $subscriber->delete();

        return view('unsubscribed');
    }
}
