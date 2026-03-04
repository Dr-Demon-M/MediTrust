<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Specialty;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            'cardiology' => [

                [
                    'name' => 'Heart Health Checkup',
                    'subtitle' => 'Comprehensive Cardiac Assessment',
                    'description' => 'A complete heart evaluation designed to detect early risk factors and maintain optimal cardiovascular health.',
                    'image' => 'services/cardiology/heart-checkup.jpg',
                    'features' => [
                        'ECG & Cardiac Screening',
                        'Blood Pressure Monitoring',
                        'Cholesterol Risk Evaluation',
                        'Specialist Consultation',
                    ],
                ],

                [
                    'name' => 'ECG & Cardiac Monitoring',
                    'subtitle' => 'Advanced Heart Rhythm Analysis',
                    'description' => 'Accurate electrocardiogram testing to evaluate heart rhythm and detect abnormalities.',
                    'image' => 'services/cardiology/ecg-monitoring.jpg',
                    'features' => [
                        '12-Lead ECG Test',
                        'Arrhythmia Detection',
                        'Digital Report Analysis',
                        'Immediate Medical Review',
                    ],
                ],

                [
                    'name' => 'Hypertension Management',
                    'subtitle' => 'Blood Pressure Control Program',
                    'description' => 'Personalized treatment plans for managing high blood pressure and preventing complications.',
                    'image' => 'services/cardiology/hypertension.jpg',
                    'features' => [
                        'Routine BP Monitoring',
                        'Medication Adjustment',
                        'Lifestyle Counseling',
                        'Ongoing Follow-up',
                    ],
                ],

                [
                    'name' => 'Cardiology Consultation',
                    'subtitle' => 'Specialist Heart Consultation',
                    'description' => 'In-depth consultation with a cardiologist for accurate diagnosis and treatment planning.',
                    'image' => 'services/cardiology/consultation.jpg',
                    'features' => [
                        'Medical History Review',
                        'Heart Examination',
                        'Diagnostic Planning',
                        'Treatment Recommendations',
                    ],
                ],
            ],

            'pediatrics' => [

                [
                    'name' => 'Child Wellness Checkup',
                    'subtitle' => 'Routine Pediatric Evaluation',
                    'description' => 'Comprehensive health assessments to monitor growth and development in children.',
                    'image' => 'services/pediatrics/checkup.jpg',
                    'features' => [
                        'Growth Monitoring',
                        'Physical Examination',
                        'Vaccination Review',
                        'Parental Guidance',
                    ],
                ],

                [
                    'name' => 'Vaccination Service',
                    'subtitle' => 'Child Immunization Program',
                    'description' => 'Safe and effective vaccination services following recommended schedules.',
                    'image' => 'services/pediatrics/vaccination.jpg',
                    'features' => [
                        'Routine Immunizations',
                        'Vaccination Records',
                        'Preventive Care Advice',
                        'Follow-up Scheduling',
                    ],
                ],

                [
                    'name' => 'Pediatric Consultation',
                    'subtitle' => 'Specialized Child Consultation',
                    'description' => 'Diagnosis and management of common childhood illnesses and conditions.',
                    'image' => 'services/pediatrics/consultation.jpg',
                    'features' => [
                        'Fever & Infection Treatment',
                        'Nutritional Advice',
                        'Developmental Assessment',
                        'Medical Prescription',
                    ],
                ],

                [
                    'name' => 'Newborn Care',
                    'subtitle' => 'Infant Health Monitoring',
                    'description' => 'Comprehensive newborn health assessments and parental support services.',
                    'image' => 'services/pediatrics/newborn.jpg',
                    'features' => [
                        'Newborn Screening',
                        'Weight & Feeding Monitoring',
                        'Jaundice Assessment',
                        'Parental Counseling',
                    ],
                ],
            ],
            'neurology' => [

                [
                    'name' => 'Neurological Examination',
                    'subtitle' => 'Comprehensive Brain & Nerve Assessment',
                    'description' => 'Detailed neurological evaluation to diagnose disorders affecting the brain and nervous system.',
                    'image' => 'services/neurology/examination.jpg',
                    'features' => [
                        'Reflex & Motor Testing',
                        'Cognitive Assessment',
                        'Nerve Function Evaluation',
                        'Personalized Treatment Plan',
                    ],
                ],

                [
                    'name' => 'Migraine Management',
                    'subtitle' => 'Chronic Headache Treatment Program',
                    'description' => 'Personalized treatment plans to manage migraines and improve quality of life.',
                    'image' => 'services/neurology/migraine.jpg',
                    'features' => [
                        'Trigger Identification',
                        'Medication Management',
                        'Lifestyle Modification Plan',
                        'Follow-up Monitoring',
                    ],
                ],

                [
                    'name' => 'Epilepsy Evaluation',
                    'subtitle' => 'Seizure Diagnosis & Monitoring',
                    'description' => 'Advanced assessment and monitoring for seizure disorders.',
                    'image' => 'services/neurology/epilepsy.jpg',
                    'features' => [
                        'EEG Testing',
                        'Seizure Pattern Analysis',
                        'Medication Adjustment',
                        'Long-term Care Plan',
                    ],
                ],

                [
                    'name' => 'Stroke Follow-up Care',
                    'subtitle' => 'Post-Stroke Rehabilitation Support',
                    'description' => 'Ongoing evaluation and rehabilitation planning after stroke recovery.',
                    'image' => 'services/neurology/stroke.jpg',
                    'features' => [
                        'Neurological Monitoring',
                        'Rehabilitation Coordination',
                        'Mobility Assessment',
                        'Recovery Progress Tracking',
                    ],
                ],
            ],
            'orthopedics' => [

                [
                    'name' => 'Joint Pain Treatment',
                    'subtitle' => 'Comprehensive Joint Evaluation',
                    'description' => 'Diagnosis and treatment for knee, hip, and shoulder joint pain.',
                    'image' => 'services/orthopedics/joint-pain.jpg',
                    'features' => [
                        'X-ray Assessment',
                        'Mobility Testing',
                        'Pain Management Plan',
                        'Rehabilitation Guidance',
                    ],
                ],

                [
                    'name' => 'Fracture Management',
                    'subtitle' => 'Bone Injury Treatment',
                    'description' => 'Professional care for bone fractures with advanced treatment techniques.',
                    'image' => 'services/orthopedics/fracture.jpg',
                    'features' => [
                        'Fracture Diagnosis',
                        'Casting & Stabilization',
                        'Surgical Consultation',
                        'Healing Monitoring',
                    ],
                ],

                [
                    'name' => 'Spine Assessment',
                    'subtitle' => 'Back & Spine Care',
                    'description' => 'Comprehensive evaluation and treatment for spinal disorders.',
                    'image' => 'services/orthopedics/spine.jpg',
                    'features' => [
                        'Posture Evaluation',
                        'Disc Assessment',
                        'Physical Therapy Plan',
                        'Pain Relief Strategies',
                    ],
                ],

                [
                    'name' => 'Sports Injury Care',
                    'subtitle' => 'Athletic Injury Rehabilitation',
                    'description' => 'Specialized care for sports-related injuries and recovery.',
                    'image' => 'services/orthopedics/sports-injury.jpg',
                    'features' => [
                        'Injury Diagnosis',
                        'Rehabilitation Program',
                        'Muscle Strengthening',
                        'Return-to-Activity Plan',
                    ],
                ],
            ],
            'ophthalmology' => [

                [
                    'name' => 'Comprehensive Eye Exam',
                    'subtitle' => 'Advanced Vision Assessment',
                    'description' => 'Complete eye examination using modern diagnostic tools.',
                    'image' => 'services/ophthalmology/eye-exam.jpg',
                    'features' => [
                        'Vision Testing',
                        'Retina Examination',
                        'Eye Pressure Measurement',
                        'Prescription Evaluation',
                    ],
                ],

                [
                    'name' => 'Cataract Evaluation',
                    'subtitle' => 'Lens Health Assessment',
                    'description' => 'Early detection and management planning for cataract conditions.',
                    'image' => 'services/ophthalmology/cataract.jpg',
                    'features' => [
                        'Lens Examination',
                        'Surgical Planning',
                        'Pre-Operative Testing',
                        'Post-Treatment Guidance',
                    ],
                ],

                [
                    'name' => 'Glaucoma Screening',
                    'subtitle' => 'Eye Pressure Monitoring',
                    'description' => 'Screening and monitoring to prevent optic nerve damage.',
                    'image' => 'services/ophthalmology/glaucoma.jpg',
                    'features' => [
                        'Intraocular Pressure Test',
                        'Visual Field Test',
                        'Optic Nerve Analysis',
                        'Risk Assessment',
                    ],
                ],

                [
                    'name' => 'Laser Vision Consultation',
                    'subtitle' => 'Vision Correction Evaluation',
                    'description' => 'Professional consultation for laser vision correction procedures.',
                    'image' => 'services/ophthalmology/laser.jpg',
                    'features' => [
                        'Eligibility Screening',
                        'Corneal Mapping',
                        'Procedure Explanation',
                        'Post-Procedure Planning',
                    ],
                ],
            ],
            'dermatology' => [

                [
                    'name' => 'Skin Consultation',
                    'subtitle' => 'Comprehensive Skin Assessment',
                    'description' => 'Professional evaluation of various skin conditions.',
                    'image' => 'services/dermatology/consultation.jpg',
                    'features' => [
                        'Skin Analysis',
                        'Diagnosis & Treatment Plan',
                        'Medication Prescription',
                        'Follow-up Care',
                    ],
                ],

                [
                    'name' => 'Acne Treatment',
                    'subtitle' => 'Personalized Acne Management',
                    'description' => 'Targeted treatment plans for acne and related skin concerns.',
                    'image' => 'services/dermatology/acne.jpg',
                    'features' => [
                        'Skin Evaluation',
                        'Medical Therapy',
                        'Lifestyle Advice',
                        'Progress Monitoring',
                    ],
                ],

                [
                    'name' => 'Laser Skin Therapy',
                    'subtitle' => 'Advanced Skin Rejuvenation',
                    'description' => 'Modern laser treatments for pigmentation and skin rejuvenation.',
                    'image' => 'services/dermatology/laser.jpg',
                    'features' => [
                        'Pigmentation Treatment',
                        'Scar Reduction',
                        'Skin Tightening',
                        'Minimal Downtime',
                    ],
                ],

                [
                    'name' => 'Allergy & Rash Treatment',
                    'subtitle' => 'Skin Allergy Care',
                    'description' => 'Diagnosis and management of allergic and inflammatory skin conditions.',
                    'image' => 'services/dermatology/allergy.jpg',
                    'features' => [
                        'Allergy Testing',
                        'Medication Plan',
                        'Irritation Relief',
                        'Preventive Guidance',
                    ],
                ],
            ],
            'endocrinology' => [

                [
                    'name' => 'Diabetes Management',
                    'subtitle' => 'Comprehensive Blood Sugar Control',
                    'description' => 'Personalized diabetes care focused on long-term control and prevention.',
                    'image' => 'services/endocrinology/diabetes.jpg',
                    'features' => [
                        'Blood Sugar Monitoring',
                        'Medication Adjustment',
                        'Dietary Planning',
                        'Regular Follow-up',
                    ],
                ],

                [
                    'name' => 'Thyroid Evaluation',
                    'subtitle' => 'Thyroid Function Assessment',
                    'description' => 'Diagnosis and management of thyroid disorders.',
                    'image' => 'services/endocrinology/thyroid.jpg',
                    'features' => [
                        'Hormone Level Testing',
                        'Ultrasound Examination',
                        'Medication Plan',
                        'Long-term Monitoring',
                    ],
                ],

                [
                    'name' => 'Hormonal Assessment',
                    'subtitle' => 'Endocrine System Evaluation',
                    'description' => 'Comprehensive testing for hormonal imbalances.',
                    'image' => 'services/endocrinology/hormonal.jpg',
                    'features' => [
                        'Laboratory Testing',
                        'Hormone Analysis',
                        'Treatment Strategy',
                        'Follow-up Monitoring',
                    ],
                ],

                [
                    'name' => 'Metabolic Disorder Consultation',
                    'subtitle' => 'Metabolic Health Management',
                    'description' => 'Diagnosis and management of metabolic conditions.',
                    'image' => 'services/endocrinology/metabolic.jpg',
                    'features' => [
                        'Metabolic Testing',
                        'Lifestyle Counseling',
                        'Medication Guidance',
                        'Ongoing Evaluation',
                    ],
                ],
            ],

        ];

        foreach ($data as $slug => $services) {

            $specialty = Specialty::where('slug', $slug)->first();
            if (!$specialty) continue;

            foreach ($services as $index => $service) {

                Service::updateOrCreate(
                    [
                        'name' => $service['name'],
                        'specialty_id' => $specialty->id,
                    ],
                    [
                        'subtitle' => $service['subtitle'],
                        'description' => $service['description'],
                        'image' => $service['image'],
                        'features' => $service['features'],
                        'price' => rand(400, 1500),
                        'duration' => rand(20, 60),
                        'featured_service' => rand(0, 1),
                    ]
                );
            }
        }
    }
}
