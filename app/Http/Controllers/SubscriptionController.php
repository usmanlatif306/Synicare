<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Notifications\SubscritionCancelNotification;
use App\Notifications\SubscritionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plan = Plan::select(['stripe_name'])->first();
        $user = Auth::user();
        $subscription = $user->subscribed($plan->stripe_name);
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

        $user->notify(new SubscritionNotification());

        return redirect()->route('user.allergies.create')->with('success', 'Thank you for subscribing.');
    }

    // user all invoices
    public function userSubscriptions(Request $request)
    {
        $plan = Plan::select(['stripe_name'])->first();
        $subscription = $request->user()->subscribed($plan->stripe_name);

        $invoices = $request->user()->invoices();
        return view('user.subscriptions', compact('invoices', 'subscription', 'plan'));
        dd($invoices);
    }

    // download invoice
    public function download(Request $request, $id)
    {
        return $request->user()->downloadInvoice($id, [
            'vendor' => config('app.name'),
            'product' => auth()->user()->subscription()
        ]);
    }

    // cancel subsciption
    public function cancelSubscription(Request $request)
    {
        $plan = Plan::select(['stripe_name'])->first();
        $request->user()->subscription($plan->stripe_name)->cancel();
        $request->user()->notify(new SubscritionCancelNotification());
        return redirect()->back()->with('success', 'Subscription cancelled successfully!');
    }

    // resume subsciption
    public function resumeSubscription(Request $request)
    {
        $plan = Plan::select(['stripe_name'])->first();
        $request->user()->subscription($plan->stripe_name)->resume();
        return redirect()->back()->with('success', 'Subscription resumed successfully!');
    }
}
