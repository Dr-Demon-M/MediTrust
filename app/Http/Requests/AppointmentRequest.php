<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules(): array
    {
        $today = today()->toDateString();
        $maxDate = today()->addDays(7)->toDateString();
        return [
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'patient_email' => 'required|email|max:255',
            'patient_gender' => 'required|in:male,female',
            'patient_age' => 'required|integer|min:0',
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
