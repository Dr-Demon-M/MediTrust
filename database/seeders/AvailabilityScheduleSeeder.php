<?php

namespace Database\Seeders;

use App\Models\Availability;
use Illuminate\Database\Seeder;
use App\Models\AvailabilitySchedule;
use App\Models\Doctor;
use Carbon\Carbon;

class AvailabilityScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = Doctor::all();
        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeSlots = [
            '09:00:00',
            '10:00:00',
            '11:00:00',
            '12:00:00',
            '01:00:00',
            '02:00:00'
        ];

        foreach ($doctors as $doctor) {
            foreach ($days as $day) {
                foreach ($timeSlots as $time) {
                    Availability::create([
                        'doctor_id' => $doctor->id,
                        'day' => $day,
                        'start_time' => $time,
                        'status' => (rand(1, 10) > 8) ? 'Occupied' : 'Free',
                    ]);
                }
            }
        }
    }
}
