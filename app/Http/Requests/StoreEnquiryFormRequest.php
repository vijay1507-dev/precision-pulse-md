<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEnquiryFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
      
        $this->merge([
            'phone' => $this->phone ?? null,
            'full_name' => $this->fullName ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-\.]+$/u'],
            'email'     => ['required', 'email:rfc,dns', 'max:255'],
            'phone'     => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9\s\-]{7,20}$/'],
            'message'   => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required.',
            'full_name.regex'    => 'Name may only contain letters, spaces, hyphens, or dots.',
            'email.required'     => 'Email address is required.',
            'email.email'        => 'Please enter a valid email address.',
            'phone.regex'        => 'Phone number format is invalid.',
            'message.required'   => 'Message is required.',
            'message.min'        => 'Message must be at least 10 characters.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status'  => false,
            'message' => 'error',
            'errors'  => $validator->errors(),
        ], 422));
    }
}
