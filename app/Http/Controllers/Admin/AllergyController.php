<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allergy;
use Illuminate\Http\Request;

class AllergyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allergies = Allergy::paginate(10);
        return view('admin.allergies.index', compact('allergies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.allergies.create');
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
            'allergies' => ['required', 'string']
        ]);

        auth()->user()->allergies()->create($request->only('allergies'));

        return redirect()->route('admin.allergies.index')->with('success', 'Allergy created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function show(Allergy $allergy)
    {
        $allergy->load('medications');
        return view('admin.allergies.show', compact('allergy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function edit(Allergy $allergy)
    {
        return view('admin.allergies.edit', compact('allergy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allergy $allergy)
    {
        $request->validate([
            'allergies' => ['required', 'string']
        ]);

        $allergy->update($request->only('allergies'));

        return redirect()->back()->with('success', 'Allergy updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allergy $allergy)
    {
        $allergy->medications()->delete();
        $allergy->delete();

        return redirect()->back()->with('success', 'Allergy deleted successfully!');
    }
}
