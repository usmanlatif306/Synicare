<?php

namespace App\Http\Middleware;

use App\Models\Plan;
use Closure;
use Illuminate\Http\Request;

class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $plan = Plan::first();
        if ($plan) {
            $subscription = $plan->stripe_name;
        } else {
            $subscription = 'default';
        }
        if ($request->user() && !$request->user()->subscribed($subscription)) {
            return redirect()->route('subscription');
        }
        return $next($request);
    }
}
