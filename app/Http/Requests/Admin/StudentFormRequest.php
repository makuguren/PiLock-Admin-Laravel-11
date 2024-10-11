<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StudentFormRequest extends FormRequest
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
            'student_id' => 'required|string|unique:users,student_id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'section_id' => 'required|integer',
            'gender' => 'required|integer',
            'birthdate' => 'required|date',
            'email' => 'required|string|email|lowercase|unique:users,email',
            'password' => 'required|string|min:8|max:20'
        ];
    }
}
