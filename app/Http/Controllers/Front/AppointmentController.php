<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentLog;
use App\Models\Specialty;
use App\Notifications\NewAppointmentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();
        return view('front.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('front.appointments.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $appointment = Appointment::create($request->validated());
            $doctor = $appointment->doctor;
            AppointmentLog::create([
                'appointment_id' => $appointment->id,
                'action' => 'created',
                'service_price' => $appointment->service_price,
                'description' => 'Appointment created for patient ' . $appointment->patient_name,
                'performed_by' => $appointment->doctor_id,
            ]);
            DB::commit();
            $doctor->notify(new NewAppointmentNotification($appointment));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'There is an appointment at this time, please choose another time.');
        }
        return redirect()->route('front.appointments.create')->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('front.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
