<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\AppointmentUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentLog;
use App\Models\Availability;
use App\Models\Specialty;
use App\Notifications\NewAppointmentNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Appointment::class, 'appointment');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();
        $weekDays = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $appointments = Appointment::with(['specialty', 'service'])
            ->get()
            ->groupBy(function ($appointment) {
                return $appointment->appointment_date->format('l');
            });

        return view('Dashboard.appointment.index', compact('appointments', 'weekDays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('Dashboard.appointment.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request,)
    {
        DB::beginTransaction();
        try {
            // Logic to create the appointment goes here
            $appointment = Appointment::create($request->validated());
            $doctor = $appointment->doctor;
            $doctor->notify(new NewAppointmentNotification($appointment));
            AppointmentLog::create([
                'appointment_id' => $appointment->id,
                'action' => 'created',
                'service_price' => $appointment->service_price,
                'description' => 'Appointment created for patient ' . $appointment->patient_name,
                'performed_by' => $appointment->doctor_id,
            ]);
            Availability::create([
                'doctor_id' => $appointment->doctor_id,
                'day' => $appointment->appointment_date->format('l'),
                'start_time' => $appointment->appointment_time->format('H:i:s'),
                'status' => 'Occupied',
                'notes' => 'Appointment for patient ' . $appointment->patient_name,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'There is an appointment at this time, please choose another time.');
        }
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['specialty', 'service']);

        $doctors = $appointment->specialty->doctors;

        return view('Dashboard.appointment.show', compact('appointment', 'doctors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $specialties = Specialty::all();
        return view('Dashboard.appointment.edit', compact('appointment', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $today = today()->toDateString();
        $maxDate = today()->addDays(7)->toDateString();
        $data = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => "required|date|after_or_equal:$today|before_or_equal:$maxDate",
            'appointment_time' => 'required|date_format:H:i',
        ]);

        $appointment->update($data);
        AppointmentUpdated::dispatch($appointment);
        // event(new AppointmentUpdated($appointment));
        return redirect()->route('appointments.show', $appointment->id)->with('success', "Appointment updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function today(Request $request)
    {
        $completedAppointments = Appointment::whereDate('appointment_date', Carbon::today())
            ->where('status', 'completed')
            ->with(['specialty', 'service', 'doctor'])
            ->get();
        $confirmedAppointments = Appointment::whereDate('appointment_date', Carbon::today())
            ->filter($request->all())
            ->where('status', 'confirmed')
            ->with(['specialty', 'service', 'doctor'])
            ->get();
        $todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())
            ->with(['specialty', 'service', 'doctor'])
            ->get();
        $pendingAppointments = Appointment::whereDate('appointment_date', Carbon::today())
            ->where('status', 'pending')
            ->with(['specialty', 'service', 'doctor'])
            ->get();
        return view('Dashboard.appointment.today', compact('completedAppointments', 'confirmedAppointments', 'todayAppointments', 'pendingAppointments'));
    }

    public function pending()
    {
        $pendingAppointments = Appointment::whereDate('appointment_date', Carbon::today())
            ->where('status', 'pending')
            ->with(['specialty', 'service', 'doctor'])
            ->get();
        $todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())
            ->with(['specialty', 'service', 'doctor'])
            ->get();
        return view('Dashboard.appointment.pending', compact('pendingAppointments', 'todayAppointments'));
    }

    public function complete($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'completed';
        $appointment->save();
        return redirect()->back()->with('success', 'Appointment completed successfully.');
    }
    public function confirm($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'confirmed';
        $appointment->save();
        return redirect()->back()->with('success', 'Appointment confirmed successfully.');
    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'cancelled';
        $appointment->save();
        return redirect()->back()->with('delete', 'Appointment cancelled successfully.');
    }
}
