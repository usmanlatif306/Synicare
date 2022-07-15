<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::get();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ]);
        $data = $request->except('_token');

        $data['slug'] = strtolower($data['name']);
        $price = $data['price'] * 100;
        $product_name = explode(" ", $data['name'])[0];

        //create stripe product
        $stripeProduct = $this->stripe->products->create([
            'name' => $product_name,
        ]);

        //Stripe Plan Creation
        $stripePlanCreation = $this->stripe->plans->create([
            'amount' => $price,
            'currency' => 'usd',
            'interval' => 'month', //  it can be day,week,month or year
            'product' => $stripeProduct->id,
        ]);

        $data['stripe_name'] = strtolower($product_name);
        $data['stripe_id'] = $stripePlanCreation->id;
        $data['product_id'] = $stripeProduct->id;

        Plan::create($data);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ]);
        $this->stripe->products->update($plan->product_id, [
            'name' => $request->name,
        ]);
        $this->stripe->plans->update($plan->stripe_id, [
            'amount' => '87'
        ]);
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $this->stripe->plans->delete($plan->stripe_id);
        $this->stripe->products->delete($plan->product_id);
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully!');
    }
}
