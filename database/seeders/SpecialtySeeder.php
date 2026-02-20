<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Cardiology',
                'icon' => 'mdi-heart-pulse',
                'description' => 'Heart health and cardiovascular system specialists.',
            ],
            [
                'name' => 'Pediatrics',
                'icon' => 'mdi-baby-face-outline',
                'description' => 'Medical care for infants, children, and adolescents.',
            ],
            [
                'name' => 'Neurology',
                'icon' => 'mdi-brain',
                'description' => 'Specialists in disorders of the nervous system.',
            ],
            [
                'name' => 'Orthopedics',
                'icon' => 'mdi-bone',
                'description' => 'Focusing on the musculoskeletal system and injuries.',
            ],
            [
                'name' => 'Ophthalmology',
                'icon' => 'mdi-eye',
                'description' => 'Diagnosis and treatment of eye disorders.',
            ],
            [
                'name' => 'Dermatology',
                'icon' => 'mdi-face-woman-outline',
                'description' => 'Specialists in skin, hair, and nail conditions.',
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create([
                'name' => $specialty['name'],
                'slug' => Str::slug($specialty['name']),
                'icon' => $specialty['icon'],
                'description' => $specialty['description'],
                'is_active' => true,
            ]);
        }
    }
}
