<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'specialty_id' => 'required|int|exists:specialties,id',
            'years_experience' => 'nullable|integer|min:0',
            'consultation_fee' => 'required|numeric|min:0',
            'bio' => 'nullable|string|max:2000',
            'status' => 'required|in:active,inactive,on_leave',
            'rating' => 'nullable|numeric|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The doctor name is required.',
            'specialty.required' => 'The professional title/specialty is required.',
            'consultation_fee.required' => 'Please set the consultation fee for the clinic.',
            'status.in' => 'The status must be Active, Inactive, or On Leave.',
            'rating.max' => 'The rating cannot exceed 5.0.',
            'photo.image' => 'The uploaded file must be an image.',
            'photo.max' => 'The photo size should not exceed 2MB.',
        ];
    }
}
