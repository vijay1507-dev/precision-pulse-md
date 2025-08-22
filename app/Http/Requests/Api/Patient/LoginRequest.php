<?php

namespace App\Http\Requests\Api\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->incrementLoginAttempts();
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.exists' => 'This email is not registered as a Patient.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->incrementLoginAttempts();

        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422)
        );
    }

    protected function ensureIsNotRateLimited(): void
    {
        $key = $this->throttleKey();

        if (!RateLimiter::tooManyAttempts($key, 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($key);

        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.'
        ], 429));
    }

    protected function incrementLoginAttempts(): void
    {
        RateLimiter::hit($this->throttleKey(), 60); // lock for 60 seconds
    }

    public function throttleKey(): string
    {
        return Str::lower($this->input('email')) . '|' . $this->ip();
    }

    public function validateCredentials(): void
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->input('email'))->first();

        if (!$user || !Hash::check($this->input('password'), $user->password)) {
            $this->incrementLoginAttempts();

            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Incorrect email or password.',
            ], 401));
        }

        // If credentials are valid, clear rate limiter
        RateLimiter::clear($this->throttleKey());
    }

    public function validateResolved()
    {
        $this->ensureIsNotRateLimited(); // call before validation
        parent::validateResolved();
    }
}
