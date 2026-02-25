<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'user_id' => 1,
                'name' => 'Ahmed Hassan',
                'specialty_id' => 1,
                'years_experience' => 12,
                'consultation_fee' => 350,
                'rating' => 4.8,
            ],
            [
                'user_id' => 2,
                'name' => 'Mohamed El-Sayed',
                'specialty_id' => 2,
                'years_experience' => 9,
                'consultation_fee' => 300,
                'rating' => 4.5,
            ],
            [
                'user_id' => 3,
                'name' => 'Mahmoud Abdelrahman',
                'specialty_id' => 3,
                'years_experience' => 15,
                'consultation_fee' => 400,
                'rating' => 4.9,
            ],
            [
                'user_id' => 4,
                'name' => 'Mostafa Ali',
                'specialty_id' => 1,
                'years_experience' => 7,
                'consultation_fee' => 250,
                'rating' => 4.3,
            ],
            [
                'user_id' => 5,
                'name' => 'Karim Fathy',
                'specialty_id' => 2,
                'years_experience' => 10,
                'consultation_fee' => 320,
                'rating' => 4.6,
            ],
            [
                'user_id' => 6,
                'name' => 'Sherif Nabil',
                'specialty_id' => 3,
                'years_experience' => 18,
                'consultation_fee' => 450,
                'rating' => 4.9,
            ],
            [
                'user_id' => 7,
                'name' => 'Tamer Youssef',
                'specialty_id' => 1,
                'years_experience' => 6,
                'consultation_fee' => 220,
                'rating' => 4.2,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create([
                'user_id' => $doctor['user_id'],
                'name' => $doctor['name'],
                'slug' => Str::slug($doctor['name']),
                'photo' => 'default-doctor.png',
                'specialty_id' => $doctor['specialty_id'],
                'years_experience' => $doctor['years_experience'],
                'consultation_fee' => $doctor['consultation_fee'],
                'rating' => $doctor['rating'],
                'status' => 'active',
                'bio' => $doctor['name'] . ' is an experienced specialist dedicated to providing high quality medical care.',
            ]);
        }
    }
}
