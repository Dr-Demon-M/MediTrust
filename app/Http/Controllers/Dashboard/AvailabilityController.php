<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailabilityRequest;
use App\Models\Availability;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Services\AvailabilityService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny', Availability::class);
        $doctors = Doctor::filter($request->query())->with('specialty')->get();
        $specialties = Specialty::all();
        return view('Dashboard.availability.index', compact('doctors', 'specialties'));
    }


    public function show($slug)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        $startOfWeek = now()->startOfWeek(Carbon::SATURDAY);
        $endOfWeek = $startOfWeek->copy()->endOfWeek(Carbon::FRIDAY);

        $availabilities = $doctor->availability;
        $appointments = $doctor->appointments()
            ->whereBetween('appointment_datetime', [$startOfWeek, $endOfWeek])
            ->get();

        $weekDays = [];
        $current = $startOfWeek->copy();
        while ($current <= $endOfWeek) {
            $weekDays[] = $current->copy();
            $current->addDay();
        }

        $weeklySlots = [];

        foreach ($weekDays as $date) {
            $dayName = $date->format('l');
            $dayAvails = $availabilities->where('day', $dayName);

            // فلترة مواعيد هذا اليوم فقط
            $currentDayAppointments = $appointments->filter(function ($appt) use ($date) {
                return Carbon::parse($appt->appointment_datetime)->isSameDay($date);
            });

            $daySlots = [];

            foreach ($dayAvails as $avail) {
                $start = Carbon::parse($date->format('Y-m-d') . ' ' . $avail->start_time);
                $end = Carbon::parse($date->format('Y-m-d') . ' ' . $avail->end_time);
                $duration = $avail->slot_duration ?? 60;

                // داخل حلقة الـ while لتوليد الـ Slots
                while ($start < $end) {
                    $slotEnd = $start->copy()->addMinutes($duration);

                    // 1. تحقق أولاً هل الوقت قد مضى (Past)؟
                    if ($start->isPast()) {
                        $status = 'past';
                    }
                    // 2. إذا لم يفت، تحقق هل هو غير متاح يدوياً؟
                    elseif ($avail->status === 'inactive') {
                        $status = 'inactive';
                    }
                    // 3. إذا كان متاحاً ومستقبلياً، نتحقق من الحجز
                    else {
                        $bookedAppointment = $currentDayAppointments->first(function ($appt) use ($start, $slotEnd) {
                            $apptTime = Carbon::parse($appt->appointment_datetime);
                            return $apptTime >= $start && $apptTime < $slotEnd;
                        });

                        $status = $bookedAppointment ? 'booked' : 'available';
                    }

                    $daySlots[] = [
                        'time'   => $start->format('h:i A'),
                        'status' => $status
                    ];

                    $start->addMinutes($duration);
                }
            }
            $weeklySlots[$date->format('Y-m-d')] = $daySlots;
        }

        return view('Dashboard.Doctors.availability', compact('weekDays', 'weeklySlots', 'doctor'));
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

        return redirect()->route('availability.show', $slug)->with('success', 'Schedule Added Successfully');
    }

    public function destroy($slug, $day)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();

        // 1. جلب كل فترات العمل المسجلة لهذا اليوم
        $availabilities = $doctor->availability()->where('day', $day)->get();

        foreach ($availabilities as $avail) {
            // 2. تحديد وقت البداية والنهاية بناءً على تاريخ اليوم القادم الذي يوافق هذا اليوم (مثلاً السبت القادم)
            // أو ببساطة البحث في المواعيد المستقبلية التي تطابق هذا اليوم من الأسبوع

            $hasAppointments = $doctor->appointments()
                ->whereRaw("DAYNAME(appointment_datetime) = ?", [$day]) // البحث باليوم
                ->whereTime('appointment_datetime', '>=', $avail->start_time)
                ->whereTime('appointment_datetime', '<', $avail->end_time)
                ->where('appointment_datetime', '>=', now()) // المواعيد القادمة فقط
                ->exists();

            if ($hasAppointments) {
                return redirect()->back()->with('error', "Cannot clear $day because there are already booked appointments in this time range!");
            }
        }
        $doctor->availability()->where('day', $day)->delete();

        return redirect()->back()->with('success', "Working hours for $day have been cleared successfully.");
    }
}
