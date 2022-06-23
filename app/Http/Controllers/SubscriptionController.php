<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscription = auth()->user()->subscription;
        return view('subscription', compact('subscription'));
    }

    // subscription method
    public function subscription(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment = Stripe\Charge::create([
            "amount" => (int)$request->price * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "This payment is for Synicare subscription",
        ]);

        $subscription = auth()->user()->subscription;
        $remaining_days = 0;
        if ($subscription) {
            $remaining_days = $subscription->expired_at->diffInDays(now());
            auth()->user()->subscription()->update(['expired_at' => now()]);
        }
        $days = 30 + $remaining_days;


        auth()->user()->subscription()->create([
            'stripe_id' => $payment->id,
            'amount' => $request->price,
            'expired_at' => now()->addDays($days),
        ]);

        return redirect()->route('user.medications.index')->with('success', 'Thank you for subscription. You can proceed further');
    }

    // user subscriptions record
    public function userSubscriptions()
    {
        $subscriptions = auth()->user()->subscriptions()->paginate(10);
        return view('user.subscriptions', compact('subscriptions'));
    }
}
