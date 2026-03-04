<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $today = today()->toDateString();
        $maxDate = today()->addDays(7)->toDateString();
        return [
            'patient_id' => 'nullable|exists:patients,id',
            'patient_name'   => 'nullable|required_without:patient_id|string|max:255',
            'patient_phone'  => 'nullable|required_without:patient_id|string|max:20',
            'patient_email'  => 'nullable|email',
            'patient_gender' => 'nullable|required_without:patient_id|in:male,female',
            'patient_age'    => 'nullable|required_without:patient_id|integer|min:0|max:120',
            'specialty_id' => 'required|exists:specialties,id',
            'service_id' => 'required|exists:services,id',
            'doctor_id' => 'required|exists:doctors,id',
            'service_price' => 'required|numeric|min:0',
            'appointment_datetime' => "required|date|after_or_equal:$today|before_or_equal:$maxDate",
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'patient_notes' => 'nullable|string|max:1000',
            'admin_notes' => 'nullable|string|max:1000',
        ];
    }
}
