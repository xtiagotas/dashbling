<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\User;
use Laravel\Cashier\Subscription;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        LOG::info('event type: ' . $event->type);

        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;
            case 'customer.subscription.created':
                $this->handleSubscriptionCreated($event->data->object);
                break;
            case 'customer.subscription.updated':
                $this->handleSubscriptionUpdated($event->data->object);
                break;
            case 'customer.subscription.deleted':
                $this->handleSubscriptionDeleted($event->data->object);
                break;
            case 'invoice.payment_succeeded':
                $this->handleInvoicePaymentSucceeded($event->data->object);
                break;
            case 'invoice.payment_failed':
                $this->handleInvoicePaymentFailed($event->data->object);
                break;
            case 'invoice.upcoming':
                $this->handleInvoiceUpcoming($event->data->object);
                break;
                // Handle other event types as needed
            default:
                Log::warning('Unhandled event type: ' . $event->type);
        }

        return response()->json(['status' => 'success'], 200);
    }

    protected function handleCheckoutSessionCompleted($session)
    {
        $user_id = $session->customer;
        $user = User::find($user_id);

        if ($user && isset($session->subscription)) {
            $subscription_id = $session->subscription;
            $user->subscriptions()->updateOrCreate([
                'type' => 'stripe',
                'stripe_id' => $subscription_id,
                'stripe_status' => 'active',
                'stripe_price' => $session->display_items[0]->price->id ?? null,
                'quantity' => 1,
            ]);
        }
    }

    protected function handleSubscriptionCreated($subscription)
    {
        $user = User::where('stripe_id', $subscription->customer)->first();
        if ($user) {
            $user->subscriptions()->updateOrCreate([
                'type' => 'stripe',
                'stripe_id' => $subscription->id,
                'stripe_status' => $subscription->status,
                'stripe_price' => $subscription->items->data[0]->price->id ?? null,
                'quantity' => $subscription->quantity,
            ]);
        }
    }

    protected function handleSubscriptionUpdated($subscription)
    {
        $user = User::where('stripe_id', $subscription->customer)->first();
        if ($user) {
            $user->subscriptions()->where('stripe_id', $subscription->id)->update([
                'stripe_status' => $subscription->status,
                'stripe_price' => $subscription->items->data[0]->price->id ?? null,
                'quantity' => $subscription->quantity,
            ]);
        }
    }

    protected function handleSubscriptionDeleted($subscription)
    {
        $user = User::where('stripe_id', $subscription->customer)->first();
        if ($user) {
            $user->subscriptions()->where('stripe_id', $subscription->id)->update(['stripe_status' => 'canceled']);
        }
    }

    protected function handleInvoicePaymentSucceeded($invoice)
    {
        $subscription = Subscription::where('stripe_id', $invoice->subscription)->first();
        if ($subscription) {
            $subscription->update(['stripe_status' => 'active']);
        }
    }

    protected function handleInvoicePaymentFailed($invoice)
    {
        $subscription = Subscription::where('stripe_id', $invoice->subscription)->first();
        if ($subscription) {
            $subscription->update(['stripe_status' => 'past_due']);
        }
    }

    protected function handleInvoiceUpcoming($invoice)
    {
        // Optional: Notify the user about the upcoming invoice
    }
}
