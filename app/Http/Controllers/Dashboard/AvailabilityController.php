<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function availabilitySchedule(Request $request)
    {
        $doctors = Doctor::filter($request->query())->with('specialty')->get();
        $specialties = Specialty::all();
        return view('Dashboard.availability.index', compact('doctors', 'specialties'));
    }

    public function showAvailabilitySchedule($slug)
    {
        $doctor = Doctor::with('specialty')->where('slug', $slug)->firstOrFail();
        // جلب المواعيد وتحويلها لمصفوفة مفتاحها "Day-Time"
        $schedules = Availability::where('doctor_id', $doctor->id)
            ->get()
            ->mapWithKeys(function ($item) {
                // تحويل الوقت من 13:00:00 إلى 01:00 PM ليتطابق مع الـ Blade
                $timeKey = \Carbon\Carbon::parse($item->start_time)->format('h:00 A');
                return ["{$item->day}-{$timeKey}" => $item->status];
            })->toArray();
        return view('Dashboard.Doctors.availability', compact('doctor', 'schedules'));
    }

    public function deleteAvailabilitySchedule($slug)
    {
        $doctor = Doctor::with('specialty')->where('slug', $slug)->firstOrFail();
        $doctor->availability()->delete();
        return redirect()->route('availability-schedule.index')->with('error', 'Schedule Deleted Successfully');
    }

    public function addAvailabilitySchedule(Request $request, string $slug)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        $data = $request->validate([
            'day' => 'required|string|in:Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday',
            'start_time' => 'required|date_format:H:i:s|in:09:00:00,10:00:00,11:00:00,12:00:00,13:00:00,14:00:00',
            'status' => 'required|string|in:Away,Free,Occupied',
            'notes' => 'nullable|string|max:255'
        ]);
        $data['doctor_id'] = $doctor->id;
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        $exists = Availability::where('doctor_id', $doctor->id)
            ->where('day', $request->day)
            ->where('start_time', $request->start_time)
            ->exists();
        if ($exists) {
            return redirect()->back()
                ->with(['error' => "This time is already taken. Please choose a different time or day."]);
        }
        Availability::create($data);
        return redirect()->route('availability-schedule.show', $slug)->with('success', 'Schedule Added Successfully');
    }
}
