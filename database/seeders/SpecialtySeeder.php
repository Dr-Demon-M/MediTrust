<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;
use Illuminate\Support\Str;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Cardiology',
                'subtitle' => 'HEART & VASCULAR CARE',
                'icon' => 'mdi-heart-pulse',
                'image' => 'specialties/cardiology.jpg',
                'procedures_count' => 500,
                'description' => 'Comprehensive cardiac care including diagnosis and advanced treatment.',
                'features' => [
                    'Advanced Cardiac Surgery',
                    'Interventional Cardiology',
                    'Heart Rhythm Management',
                ]
            ],
            [
                'name' => 'Pediatrics',
                'subtitle' => 'CHILD & ADOLESCENT CARE',
                'icon' => 'mdi-baby-face-outline',
                'image' => 'specialties/pediatrics.jpg',
                'procedures_count' => 1200,
                'description' => 'Dedicated healthcare services for infants and children.',
                'features' => [
                    'Routine Child Checkups',
                    'Vaccination Programs',
                    'Growth Monitoring',
                ]
            ],
            [
                'name' => 'Neurology',
                'subtitle' => 'BRAIN & NERVOUS SYSTEM',
                'icon' => 'mdi-brain',
                'image' => 'specialties/neurology.jpg',
                'procedures_count' => 350,
                'description' => 'Diagnosis and management of neurological disorders.',
                'features' => [
                    'Stroke Management',
                    'Epilepsy Treatment',
                    'Neurodiagnostic Testing',
                ]
            ],
            [
                'name' => 'Orthopedics',
                'subtitle' => 'BONE & JOINT CARE',
                'icon' => 'mdi-bone',
                'image' => 'specialties/orthopedics.jpg',
                'procedures_count' => 800,
                'description' => 'Comprehensive treatment for bone and joint conditions.',
                'features' => [
                    'Joint Replacement',
                    'Sports Injury Treatment',
                    'Spine Care',
                ]
            ],
            [
                'name' => 'Ophthalmology',
                'subtitle' => 'EYE & VISION CARE',
                'icon' => 'mdi-eye-outline',
                'image' => 'specialties/ophthalmology.jpg',
                'procedures_count' => 650,
                'description' => 'Advanced eye care services including surgical procedures.',
                'features' => [
                    'Vision Testing',
                    'Cataract Surgery',
                    'Laser Eye Treatment',
                ]
            ],
            [
                'name' => 'Dermatology',
                'subtitle' => 'SKIN & COSMETIC CARE',
                'icon' => 'mdi-face-man',
                'image' => 'specialties/dermatology.jpg',
                'procedures_count' => 900,
                'description' => 'Medical and cosmetic treatments for skin conditions.',
                'features' => [
                    'Acne Treatment',
                    'Laser Therapy',
                    'Skin Allergy Management',
                ]
            ],
            [
                'name' => 'Endocrinology',
                'subtitle' => 'HORMONE & METABOLIC CARE',
                'icon' => 'mdi-flask-outline',
                'image' => 'specialties/endocrinology.jpg',
                'procedures_count' => 400,
                'description' => 'Specialized care for hormonal disorders including diabetes.',
                'features' => [
                    'Diabetes Management',
                    'Thyroid Disorders',
                    'Hormonal Imbalance Treatment',
                ]
            ],
        ];

        foreach ($data as $item) {
            Specialty::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'name' => $item['name'],
                    'slug' => Str::slug($item['name']),
                    'subtitle' => $item['subtitle'],
                    'icon' => $item['icon'],
                    'image' => $item['image'],
                    'procedures_count' => $item['procedures_count'],
                    'description' => $item['description'],
                    'features' => $item['features'],
                ]
            );
        }
    }
}