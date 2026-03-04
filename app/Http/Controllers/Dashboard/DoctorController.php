<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Appointment;
use App\Models\Availability;
use App\Models\Doctor;
use App\Models\specialty;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Doctor::class, 'doctor');
    }
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
        DB::beginTransaction();
        try {
            $data['photo'] = $path;
            $data['slug'] = Doctor::generateUniqueSlug('Dr-' . $request->name);
            Doctor::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add doctor: all fields are required and must be valid. Please try again.');
        }
        return redirect()->route('doctors.index')->with('success', 'Doctor Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $slug = $doctor->slug;
        $patients = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'completed')
            ->count();
        $lastConsultation = $doctor->appointments()
            ->where('status', 'completed')
            ->latest('appointment_datetime')
            ->first();

        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        $rating = $doctor->rating; // 2.5
        $fullStars = floor($rating); // 2   
        $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0; // 1
        $emptyStars = 5 - ($fullStars + $halfStar); // 2
        return view('Dashboard.Doctors.show', compact('doctor', 'rating', 'fullStars', 'halfStar', 'emptyStars', 'patients', 'lastConsultation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $specialties = specialty::all();
        return view('Dashboard.Doctors.edit', compact('doctor', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $data = $request->except('photo');
        if ($request->hasFile('photo')) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $this->uploadImage($request);
        }
        if ($doctor->name !== $request->name) {
            $data['slug'] = Doctor::generateUniqueSlug('Dr-' . $request->name);
        }

        $doctor->update($data);

        return redirect()->route('doctors.index')->with('updated', 'Doctor updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
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

    public function docProfile()
    {
        $doctor = auth()->user()->doctor;
        $specialties = specialty::all();
        return view('Dashboard.Doctors.profile', compact(['doctor', 'specialties']));
    }

    public function docProfile2()
    {
        $doctor = auth()->user()->doctor;
        $specialties = specialty::all();
        return view('Dashboard.Doctors.profile-show', compact(['doctor', 'specialties']));
    }
}
