<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        'user_id' => 'unique:profiles,user_id',
        'name'=> 'required|string',
        'phone'=> 'nullable|string',
        'address'=> 'nullable|string'
        ];
    }
    public function messages()
{
    return [
        'user_id.required' => 'User ID is required.',
        'user_id.exists' => 'The specified user does not exist.',
        'name.required' => 'Name is required.',
        'name.string' => 'Name must be a valid string.',
        'phone.string' => 'Phone must be a valid string.',
        'address.string' => 'Address must be a valid string.',
    ];
}

}
