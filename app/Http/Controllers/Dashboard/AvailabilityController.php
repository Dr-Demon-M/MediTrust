<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailabilityRequest;
use App\Models\Availability;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Services\AvailabilityService;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{

    public function availabilitySchedule(Request $request)
    {
        $this->authorize('viewAny', Availability::class);
        $doctors = Doctor::filter($request->query())->with('specialty')->get();
        $specialties = Specialty::all();
        return view('Dashboard.availability.index', compact('doctors', 'specialties'));
    }

    public function showAvailabilitySchedule($slug)
    {
        $doctor = Doctor::with('specialty')->where('slug', $slug)->firstOrFail();
        $this->authorize('view', $doctor);
        $appointments = $doctor
            ->appointments()
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();
        $schedules = Availability::where('doctor_id', $doctor->id)
            ->get()
            ->mapWithKeys(function ($item) {
                $timeKey = \Carbon\Carbon::parse($item->start_time)->format('h:00 A');
                return ["{$item->day}-{$timeKey}" => $item->status];
            })->toArray();
        return view('Dashboard.Doctors.availability', compact('doctor', 'schedules', 'appointments'));
    }

    public function addAvailabilitySchedule(AvailabilityRequest $request, string $slug, AvailabilityService $service)
    {
        $this->authorize('create', Availability::class);
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        $data = $request->validated();
        try {
            $service->create($doctor, $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('availability-schedule.show', $slug)->with('success', 'Schedule Added Successfully');
    }

    public function deleteAvailabilitySchedule($slug, Availability $availability)
    {
        $this->authorize('delete', $availability);
        $doctor = Doctor::with('specialty')->where('slug', $slug)->firstOrFail();
        if ($availability->doctor_id !== $doctor->id) {
            abort(404);
        }
        $availability->delete();
        return redirect()->route('availability-schedule.index')->with('error', 'Schedule Table Deleted Successfully');
    }
}
