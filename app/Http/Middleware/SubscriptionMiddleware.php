<?php

namespace App\Http\Middleware;

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
        if (auth()->user()->subscription) {
            return $next($request);
        }
        return redirect()->route('subscription')->with('error', 'User has not active subscription. Kindly subscribe before further proceed!');
    }
}
