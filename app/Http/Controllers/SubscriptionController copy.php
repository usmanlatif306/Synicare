<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class SubscriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $subscription = $user->subscribed('default');
        $intent = $user->createSetupIntent();
        $plan = Plan::first();
        return view('subscription', compact('subscription', 'intent', 'plan'));
    }

    // subscription method
    public function subscription(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->input('payment-method');
        $plan = Plan::where('stripe_id', $request->plan)->first();

        $user->newSubscription($plan->stripe_name, $plan->stripe_id)
            ->create($paymentMethod, [
                'email' => $user->email,
            ]);
        dd($request->all());
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment = Stripe\Charge::create([
            "amount" => (int)$request->price * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "This payment is for Synicare subscription",
        ]);

        $subscription = auth()->user()->subscribed('default');
        $remaining_days = 0;
        // if ($subscription) {
        //     $remaining_days = $subscription->expired_at->diffInDays(now());
        //     auth()->user()->subscription()->update(['expired_at' => now()]);
        // }
        $days = 30 + $remaining_days;


        auth()->user()->subscription()->create([
            'stripe_id' => $payment->id,
            'amount' => $request->price,
            'expired_at' => now()->addDays($days),
        ]);

        return redirect()->route('user.allergies.create')->with('success', 'Thank you for subscription. You can proceed further.');
    }

    // user subscriptions record
    public function userSubscriptions()
    {
        $subscriptions = auth()->user()->subscriptions()->paginate(10);
        return view('user.subscriptions', compact('subscriptions'));
    }
}
