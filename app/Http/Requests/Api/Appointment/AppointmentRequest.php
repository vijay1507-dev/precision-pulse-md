<?php

namespace App\Http\Requests\Api\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\ValidDoctor;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('scheduled_at')) {
            $this->merge([
                'appointment_date' => $this->has('scheduled_at')
                    ? Carbon::parse($this->input('scheduled_at'))->format('Y-m-d H:i:s')
                    : null,

                'gender' => $this->has('gender')
                    ? strtolower($this->input('gender'))
                    : null,
            ]);
        }
    }

    public function rules(): array
    {
        return array_merge(
            $this->doctorRules(),
            $this->patientRules(),
            //$this->medicalHistoryRules(),
            //$this->familyHistoryRules(),
           // $this->lifestyleRules(),
            $this->paymentInfoRules()
        );
    }

    private function doctorRules(): array
    {
        return [
            'doctor_id' => ['required', 'integer', new ValidDoctor],
        ];
    }

    private function patientRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
            'height_feet' => 'nullable|integer',
            'height_inches' => 'nullable|integer',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'reason' => 'nullable|string', 
            'patient_record' => 'nullable|array',
            'status' => 'nullable|string|in:pending,confirmed,cancelled',
            'follow_up_file' => 'nullable',
            'schedule_file' => 'nullable',
        ];
    }



    private function medicalHistoryRules(): array
    {
        return [
            'medical_history' => 'required|array',
            'medical_history.blood_type' => 'nullable|string',
            'medical_history.current_medication' => 'nullable|string',
            'medical_history.past_surgeries' => 'nullable|string',
            'medical_history.allergies' => 'nullable|string',
        ];
    }

    private function familyHistoryRules(): array
    {
        return [
            'family_history' => 'nullable|array',
        ];
    }

    private function lifestyleRules(): array
    {
        return [
            'lifestyle' => 'required|array',
            'lifestyle.smokes' => 'nullable|boolean',
            'lifestyle.drinks_alcohol' => 'nullable|boolean',
            'lifestyle.exercise_frequency' => 'nullable|string',
        ];
    }

    private function paymentInfoRules(): array
    {
        return [
            'payment_info' => 'required|array',
            'payment_info.payment_intent_id' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'doctor_id.required' => 'Please select a doctor.',
            'doctor_id.exists' => 'The selected doctor does not exist.',
            'name.required' => 'Patient name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.required' => 'Phone number is required.',
            'appointment_date.required' => 'Please select a valid appointment date and time.',
            'appointment_time.required' => 'Please select a valid appointment date and time.',
            'status.in' => 'Status must be one of: pending, confirmed, or cancelled.',
            'medical_history.required' => 'Medical history is required.',
            'lifestyle.required' => 'Lifestyle information is required.',
            'lifestyle.array' => 'Lifestyle data must be properly formatted.',
            'payment_info.array' => 'Payment information is required.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
