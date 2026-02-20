<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialtyRequest;
use App\Models\Availability;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpecialtyController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties = specialty::all();
        return view('dashboard.specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.specialties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecialtyRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);
        Specialty::create($data);
        return redirect()->route('specialties.index')->with('success', 'Specialty Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $specialty = Specialty::where('slug', $slug)->with('doctors')->first();
        $avgWaitTime = rand(10, 20);
        $availabilities = Availability::where('status', 'Occupied')
            ->whereHas('doctor', function ($query) use ($specialty) {
                $query->where('specialty_id', $specialty->id);
            })
            ->count();
        return view('dashboard.specialties.show', compact('specialty', 'avgWaitTime', 'availabilities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $specialty = Specialty::where('slug', $slug)->firstOrFail();
        return view('Dashboard.specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $specialty = Specialty::where('slug', $slug)->firstOrFail();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);
        if ($request->name !== $specialty->name) {
            $data['slug'] = Str::slug($request->name);
        };
        $specialty->update($data);
        return redirect()->route('specialties.index')->with('success', 'Specialty Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showNewAppointmentForm(string $slug)
    {
        $specialty = Specialty::where('slug', $slug)->with('doctors')->firstOrFail();
        $doctors = $specialty->doctors()->where('status', 'active')->get();
        return view('Dashboard.specialties.new-appointment', compact('specialty', 'doctors'));
    }
}
