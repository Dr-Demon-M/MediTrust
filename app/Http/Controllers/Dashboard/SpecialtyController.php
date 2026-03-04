<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialtyRequest;
use App\Models\Availability;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpecialtyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Specialty::class, 'specialty');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties = Specialty::all();
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
        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request);
            $data['image'] = $path;
        }
        Specialty::create($data);
        return redirect()->route('specialties.index')->with('success', 'Specialty Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialty $specialty)
    {
        $specialty = Specialty::where('slug', $specialty->slug)->with('doctors')->first();
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
    public function edit(Specialty $specialty)
    {
        return view('Dashboard.specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialty $specialty)
    {
        $specialty = Specialty::where('slug', $specialty->slug)->firstOrFail();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'procedures_count' => 'nullable|integer',
            'procedures_label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->name !== $specialty->name) {
            $data['slug'] = Str::slug($request->name);
        };
        if ($request->hasFile('image')) {
            if ($specialty->image) {
                Storage::disk('public')->delete($specialty->image);
            }
            $path = $this->uploadImage($request);
            $data['image'] = $path;
        }
        $specialty->update($data);
        return redirect()->route('specialties.index')->with('success', 'Specialty Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return redirect()->route('specialties.index')->with('delete', 'Specialty Deleted Successfully');
    }

    public function showNewAppointmentForm(Specialty $specialty)
    {
        $doctors = $specialty->doctors()->where('status', 'active')->get();
        return view('Dashboard.specialties.new-appointment', compact('specialty', 'doctors'));
    }

    public function uploadImage(Request $request)
    {
        if (!$request->has('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('specialities', 'public');
        return $path;
    }
}
