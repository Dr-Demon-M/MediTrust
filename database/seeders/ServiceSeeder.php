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
            'Cardiology' => [
                'Cardiology Consultation', 'ECG (Electrocardiogram)', 'Echocardiography', 
                'Holter Monitoring', 'Hypertension Management Program', 'Heart Failure Follow-up', 
                'Pre-operative Cardiac Assessment'
            ],
            'Pediatrics' => [
                'General Pediatric Consultation', 'Vaccination & Immunization', 'Newborn Checkup', 
                'Growth & Development Monitoring', 'Pediatric Nutrition Counseling', 'Asthma & Allergy Management'
            ],
            'Neurology' => [
                'Neurology Consultation', 'EEG Testing', 'Migraine Management', 
                'Epilepsy Management', 'Stroke Follow-up', 'Peripheral Neuropathy Evaluation'
            ],
            'Orthopedics' => [
                'Orthopedic Consultation', 'Joint Injection Therapy', 'Sports Injury Assessment', 
                'Fracture Evaluation', 'Back Pain Management', 'Arthritis Treatment'
            ],
            'Ophthalmology' => [
                'Comprehensive Eye Exam', 'Vision Testing', 'Glaucoma Screening', 
                'Retina Examination', 'Dry Eye Treatment', 'Diabetic Eye Screening'
            ],
            'Dermatology' => [
                'Dermatology Consultation', 'Acne Treatment Program', 'Skin Allergy Testing', 
                'Mole & Wart Removal', 'Laser Therapy', 'Psoriasis Management'
            ],
        ];

        foreach ($data as $specialtyName => $services) {
            // البحث عن التخصص بناءً على الاسم لربط الـ ID
            $specialty = Specialty::where('name', $specialtyName)->first();

            if ($specialty) {
                foreach ($services as $serviceName) {
                    Service::create([
                        'name' => $serviceName,
                        'specialty_id' => $specialty->id,
                        'description' => 'Comprehensive ' . $serviceName . ' provided by our expert medical team in the ' . $specialtyName . ' clinic.',
                        'price' => rand(200, 1000), // سعر عشوائي للعيادة
                        'duration' => 30, // المدة الافتراضية بالدقائق كما في الصورة
                        'featured_service' => rand(0, 1), // تحديد عشوائي كخدمة مميزة
                    ]);
                }
            }
        }
    }
}