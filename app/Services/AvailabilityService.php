<?php

namespace App\Services;

use App\Models\Availability;
use App\Models\Doctor;

class AvailabilityService
{
    public function create(Doctor $doctor, array $data)
    {
        $exists = Availability::where('doctor_id', $doctor->id)
            ->where('start_time', $data['start_time'])
            ->where('end_time', $data['end_time'])
            ->where('status', $data['status'])
            ->exists();

            if ($exists) {
            throw new \Exception("This time is already Busy.");
        }

        $data['doctor_id'] = $doctor->id;

        return Availability::create($data);
    }
}