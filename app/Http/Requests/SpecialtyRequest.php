<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:specialties,name,' . ($this->specialty ? $this->specialty->id : ''),
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'procedures_count' => 'nullable|integer',
            'procedures_label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The specialty name field is required.',
            'name.unique' => 'This specialty already exists in our records.',
            'name.max' => 'The specialty name may not be greater than 255 characters.',
            'subtitle.max' => 'The subtitle may not be greater than 255 characters.',
            'procedures_label.max' => 'The procedures label may not be greater than 255 characters.',
            'description.max' => 'The description may not be greater than 1000 characters.',
        ];
    }
}
