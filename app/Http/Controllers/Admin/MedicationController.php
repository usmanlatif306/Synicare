<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allergy;
use Illuminate\Http\Request;
use App\Models\Medication;
use App\Models\User;
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
        return view('admin.medications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allergies = Allergy::get(['id', 'allergies']);
        return view('admin.medications.create', compact('allergies'));
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
        $allergy = auth()->user()->allergy;
        $medication = $allergy->medications()->create($request->all());

        // if user has image in medication
        if ($request->has('image')) {
            $image = $this->UserImageUpload($request->image);
            $medication->update(['image' => $image]);
        }

        return redirect()->route('admin.medications.show', auth()->id())->with('success', 'New Medication Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allergy = User::find($id)->allergy;
        $medications = $allergy->medications()->paginate(10);
        return view('admin.medications.show', compact('allergy', 'medications'));
    }

    public function medicationShow(Medication $medication)
    {
        return view('admin.medications.view', compact('medication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function edit(Medication $medication)
    {
        return view('admin.medications.edit', compact('medication'));
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
        $id = $medication->allergy->user->id;
        $medication->delete();
        return redirect()->route('admin.medications.show', $id)->with('success', 'Medication Deleted Successfully!');
    }
}
