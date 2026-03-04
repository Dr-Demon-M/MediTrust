<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;
use App\Models\SpecialtyFeature;

class SpecialtyFeatureSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            'cardiology' => [
                [
                    'title' => 'Advanced Cardiac Surgery',
                    'description' => 'Comprehensive surgical interventions for complex heart conditions using modern techniques.',
                ],
                [
                    'title' => 'Interventional Cardiology',
                    'description' => 'Minimally invasive procedures including angioplasty and stent placement.',
                ],
                [
                    'title' => 'Heart Rhythm Management',
                    'description' => 'Diagnosis and treatment of arrhythmias using advanced monitoring systems.',
                ],
            ],

            'pediatrics' => [
                [
                    'title' => 'Routine Child Checkups',
                    'description' => 'Regular health evaluations to monitor growth and development.',
                ],
                [
                    'title' => 'Vaccination Programs',
                    'description' => 'Comprehensive immunization schedules for disease prevention.',
                ],
                [
                    'title' => 'Growth Monitoring',
                    'description' => 'Tracking physical and cognitive development milestones.',
                ],
            ],

            'neurology' => [
                [
                    'title' => 'Stroke Management',
                    'description' => 'Immediate and long-term care for stroke patients.',
                ],
                [
                    'title' => 'Epilepsy Treatment',
                    'description' => 'Advanced diagnosis and personalized seizure management plans.',
                ],
                [
                    'title' => 'Neurodiagnostic Testing',
                    'description' => 'EEG, EMG, and imaging for accurate neurological assessment.',
                ],
            ],

            'orthopedics' => [
                [
                    'title' => 'Joint Replacement',
                    'description' => 'Hip and knee replacement procedures with enhanced recovery protocols.',
                ],
                [
                    'title' => 'Sports Injury Treatment',
                    'description' => 'Comprehensive rehabilitation for athletic injuries.',
                ],
                [
                    'title' => 'Spine Care',
                    'description' => 'Diagnosis and treatment of spinal disorders and back pain.',
                ],
            ],

            'ophthalmology' => [
                [
                    'title' => 'Vision Testing',
                    'description' => 'Comprehensive eye examinations using modern diagnostic tools.',
                ],
                [
                    'title' => 'Cataract Surgery',
                    'description' => 'Safe and effective cataract removal with lens implantation.',
                ],
                [
                    'title' => 'Laser Eye Treatment',
                    'description' => 'Advanced laser procedures for vision correction.',
                ],
            ],

            'dermatology' => [
                [
                    'title' => 'Acne Treatment',
                    'description' => 'Personalized medical and cosmetic acne management.',
                ],
                [
                    'title' => 'Laser Therapy',
                    'description' => 'Laser treatments for skin rejuvenation and pigmentation issues.',
                ],
                [
                    'title' => 'Skin Allergy Management',
                    'description' => 'Diagnosis and treatment of allergic skin conditions.',
                ],
            ],

            'endocrinology' => [
                [
                    'title' => 'Diabetes Management',
                    'description' => 'Comprehensive care plans for Type 1 and Type 2 diabetes.',
                ],
                [
                    'title' => 'Thyroid Disorders',
                    'description' => 'Diagnosis and treatment of hypo- and hyperthyroidism.',
                ],
                [
                    'title' => 'Hormonal Imbalance Treatment',
                    'description' => 'Evaluation and management of endocrine system disorders.',
                ],
            ],
        ];

        foreach ($data as $slug => $features) {

            $specialty = Specialty::where('slug', $slug)->first();

            if (!$specialty) {
                continue;
            }

            foreach ($features as $index => $feature) {
                SpecialtyFeature::updateOrCreate(
                    [
                        'specialty_id' => $specialty->id,
                        'title' => $feature['title'],
                    ],
                    [
                        'description' => $feature['description'],
                        'order' => $index,
                    ]
                );
            }
        }
    }
}
