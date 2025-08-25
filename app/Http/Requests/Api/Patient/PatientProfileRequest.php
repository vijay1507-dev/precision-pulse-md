<?php

namespace App\Http\Requests\Api\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            // User fields
            'first_name'        => ['required', 'string', 'max:100'],
            'last_name'         => ['required', 'string', 'max:100'],
            'email'             => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'password'          => ['nullable', 'string', 'min:8'],

            'date_of_birth' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'gender'            => ['required', Rule::in(['male', 'female', 'other'])],
            'phone_number'      => ['required', 'regex:/^[0-9+\-\s\(\)]{7,20}$/'],
            'height_feet'       => ['nullable', 'integer', 'min:1', 'max:9'],
            'height_inches'     => ['nullable', 'numeric', 'min:0', 'max:11'],
            'weight_lbs'        => ['required', 'string'],
            'image'             => ['nullable', 'file', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.max'        => 'First name may not be greater than 100 characters.',
            'last_name.max'         => 'Last name may not be greater than 100 characters.',
            'email.required'        => 'Email is required.',
            'email.email'           => 'Please enter a valid email address.',
            'email.unique'          => 'This email is already taken.',
            'date_of_birth.before'  => 'Date of birth must be a past date.',
            'date_of_birth.before_or_equal' => 'You must be at least 18 years old.',
            'gender.in'             => 'Gender must be either male, female, or other.',
            'height_feet.integer'   => 'Height feet must be a valid number.',
            'height_feet.min'       => 'Height feet must be at least 1.',
            'height_feet.max'       => 'Height feet must not exceed 9.',
            'height_inches.numeric' => 'Height inches must be a valid number.',
            'height_inches.min'     => 'Height inches must be at least 0.',
            'height_inches.max'     => 'Height inches must not exceed 11.',
            'weight_lbs'  => 'Weight is required.',
            'phone_number.regex'    => 'Phone number format is invalid.',
        ];
    }
}
