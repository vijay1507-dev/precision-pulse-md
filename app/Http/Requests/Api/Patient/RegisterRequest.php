<?php

namespace App\Http\Requests\Api\Patient;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\User;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Set to true to allow access; implement custom logic if needed
        return true;
    }

     protected function prepareForValidation()
        {

        $this->merge([
            'password_confirmation' => $this->confirmPassoword,
            'name' => $this->firstName,
            'last_name' => $this->lastName,

        ]);
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    } 

    public function messages(): array
    {
        return [
            'name.required' => 'First name is required.',
            'last_name.required' => 'Oops! Last name can’t be empty.',
            'email.required' => 'Email address is required.',
            'email.unique' => 'Email is already taken.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Passwords do not match.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $validator->errors()
        ], 422));
    }
}