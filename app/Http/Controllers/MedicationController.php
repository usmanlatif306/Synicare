<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Models\Medication;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;

class MedicationController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.medications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allergies = auth()->user()->allergies;
        return view('user.medications.create', compact('allergies'));
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
            'medication' => ['required', 'string'],
            'doze' => ['required', 'string'],
            'frequency' => ['required', 'string'],
            'prescriber' => ['required', 'string'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ]);
        // $allergy = Allergy::find($request->allergy_id);
        $allergy = auth()->user()->allergy;
        $medication = $allergy->medications()->create($request->all());

        // if user has image in medication
        if ($request->has('image')) {
            $image = $this->UserImageUpload($request->image);
            $medication->update(['image' => $image]);
        }
        return redirect()->route('user.medications.index')->with('success', 'New Medication Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function show(Allergy $allergy, Medication $medication)
    {
        return view('user.medications.show', compact('allergy', 'medication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function edit(Medication $medication)
    {
        $allergies = auth()->user()->allergies;
        return view('user.medications.edit', compact('allergies', 'medication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medication $medication)
    {
        $request->validate([
            'medication' => ['required', 'string'],
            'doze' => ['required', 'string'],
            'frequency' => ['required', 'string'],
            'prescriber' => ['required', 'string'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ]);
        $medication->update($request->all());
        // if user has image in medication
        if ($request->has('image')) {
            $image = $this->UserImageUpload($request->image, $medication->image);
            $medication->update(['image' => $image]);
        }

        return redirect()->back()->with('success', 'Medication Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medication $medication)
    {
        $medication->delete();
        return redirect()->route('user.medications.index')->with('success', 'Medication Deleted Successfully!');
    }
}
