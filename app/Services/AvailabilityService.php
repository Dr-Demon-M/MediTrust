<?php

namespace App\Services;

use App\Models\Availability;
use App\Models\Doctor;

class AvailabilityService
{
    public function create(Doctor $doctor, array $data)
    {
        $exists = Availability::where('doctor_id', $doctor->id)
            ->where('day', $data['day'])
            ->where('start_time', $data['start_time'])
            ->exists();

        if ($exists) {
            throw new \Exception("This time is already taken.");
        }

        $data['doctor_id'] = $doctor->id;

        return Availability::create($data);
    }
}