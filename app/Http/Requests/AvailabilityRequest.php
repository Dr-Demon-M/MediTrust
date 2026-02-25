<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityRequest extends FormRequest
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
        return [
            'day' => 'required|string|in:Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday',
            'start_time' => 'required|date_format:H:i:s|in:09:00:00,10:00:00,11:00:00,12:00:00,13:00:00,14:00:00',
            'status' => 'required|string|in:Away,Free,Occupied',
            'notes' => 'nullable|string|max:255'
        ];
    }
}
