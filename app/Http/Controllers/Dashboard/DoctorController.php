<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Availability;
use App\Models\Doctor;
use App\Models\specialty;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = specialty::all();
        return view('Dashboard.Doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        $data = $request->except('photo');
        $path = $this->uploadImage($request);
        $data['photo'] = $path;
        $data['slug'] = Str::slug('dr-' . $request->name);
        Doctor::create($data);
        return redirect()->route('doctors.index')->with('success', 'Doctor Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        $rating = $doctor->rating; // 2.5
        $fullStars = floor($rating); // 2   
        $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0; // 1
        $emptyStars = 5 - ($fullStars + $halfStar); // 2
        return view('Dashboard.Doctors.show', compact('doctor', 'rating', 'fullStars', 'halfStar', 'emptyStars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        $specialties = specialty::all();
        return view('Dashboard.Doctors.edit', compact('doctor', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialty_id' => 'required|exists:specialties,id',
            'years_experience' => 'required|integer|min:0',
            'consultation_fee' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'bio' => 'nullable|string',
        ]);
        if ($request->hasFile('photo')) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $this->uploadImage($request);
        }
        if ($doctor->name !== $request->name) {
            $data['slug'] = Str::slug('dr-' . $request->name);
        }
        $doctor->update($data);
        return redirect()->route('doctors.index')->with('updated', 'Doctor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }
        $doctor->delete();
        return redirect()->route('doctors.index')->with('error', 'Doctor deleted successfully.');
    }


    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('photo')) {
            return;
        };
        $file = $request->file('photo');
        $path = $file->store('doctors', 'public');
        return $path;
    }


}
