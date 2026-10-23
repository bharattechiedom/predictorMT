<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = env('STRIPE_WEBHOOK_SECRET');

        // Try to validate signature if SDK available and secret provided
        $event = null;
        if ($webhookSecret && class_exists('\Stripe\Webhook')) {
            try {
                $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
            } catch (\UnexpectedValueException $e) {
                // Invalid payload
                Log::warning('Stripe webhook invalid payload: ' . $e->getMessage());
                return response('Invalid payload', 400);
            } catch (\Stripe\Exception\SignatureVerificationException $e) {
                Log::warning('Stripe webhook signature verification failed: ' . $e->getMessage());
                return response('Invalid signature', 400);
            }
        } else {
            // Fallback: decode payload without signature verification
            try {
                $event = json_decode($payload);
            } catch (\Exception $e) {
                Log::warning('Stripe webhook decode failed: ' . $e->getMessage());
                return response('Invalid payload', 400);
            }
        }

        $type = is_object($event) && isset($event->type) ? $event->type : ($event['type'] ?? null);
        Log::info('Stripe webhook received: ' . $type);

        // Handle checkout.session.completed
        if ($type === 'checkout.session.completed' || $type === 'checkout.session.async_payment_succeeded') {
            $session = is_object($event) ? $event->data->object : $event['data']['object'];
            $sessionId = $session->id ?? ($session['id'] ?? null);
            $planId = null;
            if (isset($session->metadata)) {
                $planId = $session->metadata->plan_id ?? ($session['metadata']['plan_id'] ?? null);
            }
            $amount = $session->amount_total ?? ($session['amount_total'] ?? null);
            $currency = $session->currency ?? ($session['currency'] ?? null);
            $customerEmail = $session->customer_details->email ?? ($session['customer_details']['email'] ?? null);
            $paymentStatus = $session->payment_status ?? ($session['payment_status'] ?? null);

            // Upsert payment record
            $payment = Payment::updateOrCreate(
                ['stripe_session_id' => $sessionId],
                [
                    'plan_id' => $planId,
                    'amount' => $amount ? ($amount / 100) : null,
                    'currency' => $currency,
                    'status' => $paymentStatus,
                    'customer_email' => $customerEmail,
                    'raw_event' => $payload
                ]
            );

            Log::info('Recorded payment for session: ' . $sessionId);
        }

        // Add other event handling here (invoice.paid, customer.subscription.created/updated etc.)

        return response('OK', 200);
    }
}
