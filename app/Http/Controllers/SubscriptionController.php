<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Laravel\Cashier\Subscription;

class SubscriptionController extends Controller
{
    public function showSubscriptionForm()
    {
        return view('subscribe');
    }

    public function processSubscription(Request $request)
    {
        $user = $request->user();

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        // Criar um cliente no Stripe com o e-mail do usuário
        if (!$user->stripe_id) {
            $customer = $stripe->customers->create([
                'name' => $user->name,
                'email' => $user->email,
                'metadata' => [
                    'user_id' => $user->id,
                ],
            ]);

            $user->stripe_id = $customer->id;
            $user->save();
        }

        // Criar uma sessão de checkout para o cliente
        $checkoutSession = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => 'price_1PRJQ5P7vjs43jNQwxQoq1px',
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'customer' => $user->stripe_id,
            'success_url' => route('subscription.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscription.cancel'),
        ]);

        return redirect($checkoutSession->url);
    }

    public function handleSubscriptionSuccess(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $session_id = $request->query('session_id');

        $session = $stripe->checkout->sessions->retrieve($session_id);

        // Recuperar o user e subscription
        $user = User::where('stripe_id', $session->customer)->first();

        if ($user && isset($session->subscription)) {
            $subscription = $stripe->subscriptions->retrieve($session->subscription);

            $user->subscriptions()->updateOrCreate([
                'type' => 'stripe',
                'stripe_id' => $subscription->id,
                'stripe_status' => $subscription->status,
                'stripe_price' => $subscription->plan->id,
                'quantity' => 1,
            ]);
        }

        return view('subscription_success');
    }

    public function showCancelConfirmForm(Request $request)
    {
        return view('subscription-cancel-confirm');
    }

    public function handleSubscriptionCancel(Request $request)
    {
        $user = $request->user();
        $subscription = Subscription::where('user_id', $user->id)->where('stripe_status', 'active')->first();

        if ($subscription) {
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $stripe->subscriptions->cancel($subscription->stripe_id);

            $subscription->update(['stripe_status' => 'canceled']);

            return view('subscription_cancel');
        }

        return redirect()->route('settings.edit')->with('error', 'Assinatura não encontrada.');
    }
}
