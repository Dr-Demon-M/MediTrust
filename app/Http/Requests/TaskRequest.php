<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            // 'user_id'=> 'required',
            'title'=> 'required|string',
            'description'=> 'nullable|string',
            'priority'=> 'required|in:high,medium,low'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'=> 'User id is required',
            'title.required'=> "You should enter the title of the task.",
            'priority.required'=> "Priority is important too.",
            'priority.in'=> "Priority must be either high, medium, or low.",
        ];
    }
}
