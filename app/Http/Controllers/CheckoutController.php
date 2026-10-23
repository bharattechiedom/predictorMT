<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Company;

class CheckoutController extends Controller
{
    public function show(Plan $plan)
    {
        return view('checkout.show', compact('plan'));
    }

    public function createSession(Request $request, Plan $plan)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',

            'line_items' => [[
                'price_data' => [
                    'currency' => strtolower(config('app.currency','cad')),
                    'product_data' => [
                        'name' => $plan->name
                    ],
                    'unit_amount' => (int) ($plan->price * 100),
                ],
                'quantity' => 1,
            ]],

            'metadata' => [
                'plan_id' => $plan->id
            ],

            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscription'),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->session_id;

        
        if (!$sessionId) {
            return redirect()->route('subscription');
        }

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $session = $stripe->checkout->sessions->retrieve($sessionId);

        if ($session->payment_status !== 'paid') {
            return redirect()->route('subscription');
        }

        // ✅ Save payment
        $payment = Payment::firstOrCreate(
            ['stripe_session_id' => $session->id],
            [
                'plan_id' => $session->metadata->plan_id,
                'amount' => $session->amount_total / 100,
                'currency' => $session->currency,
                'status' => 'paid',
                'customer_email' =>
                    $session->customer_details->email
                    ?? $session->customer_email
            ]
        );

        // ✅ Link company (optional)
        $userID = auth()->user()->id;

        // ✅ Save subscription
        Subscription::firstOrCreate(
            ['external_subscription_id' => $session->id],
            [
                'user_id' => $userID,
                'plan_id' => $payment->plan_id,
                'status' => 'active',
                'started_at' => now(),
            ]
        );


       return view('checkout.success', compact('payment'));
    }
}
