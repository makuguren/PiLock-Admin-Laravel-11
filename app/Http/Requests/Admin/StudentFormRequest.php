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
            'email' => 'required|string|email|lowercase|unique:users,email',
            'password' => 'required|string|min:8|max:20'
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Please enter a valid Student ID. This field is required.',
            'student_id.unique' => 'The Student ID you entered is already in use. Please provide a unique Student ID.',
            'first_name.required' => 'The first name is required. Please ensure this field is filled out.',
            'last_name.required' => 'The last name is required. Kindly provide the last name to proceed.',
            'section_id' => 'Please select a section. A valid section is required to continue.',
            'gender' => 'Selecting a gender is required. Please choose a valid option to proceed.',
            'email.required' => 'A valid email address is required. Kindly provide an email to continue.',
            'email.unique' => 'The email address you entered is already associated with another account. Please provide a unique email address.',
            'password.required' => 'The password field is required. Please enter a secure password.',
            'password.min' => 'The password must be between 8 and 20 characters. Please ensure your password meets this requirement.',
        ];
    }
}
