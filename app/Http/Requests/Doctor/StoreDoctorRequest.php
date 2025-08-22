<?php
namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(
            $this->basicInfoRules(),
            $this->specializationRules(),
            $this->experienceRules(),
            $this->availabilityRules()
        );
    }

    private function basicInfoRules(): array
    {
        return [
            'name'              => 'required|string|max:100',
            'last_name'         => 'required|string|max:100',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:6|confirmed',
            'gender'            => 'required|in:Male,Female,other',
            'phone'             => 'required|string|max:20',
            'about_me'          => 'required|string|max:500',
            'license_number'    => 'nullable|string|max:50',
            'npi'               => 'nullable|string|max:50',
            'profile_photo'     => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ];
    }

    private function specializationRules(): array
    {
        return [
            'specializations'   => 'required|array|min:1',
            'specializations.*' => 'required|string|max:100',
        ];
    }

    private function experienceRules(): array
    {
        return [
            'experiences'       => 'nullable|array',
            'experiences.*.hospital_name' => 'required|string|max:100',
            'experiences.*.address'       => 'required|string|max:150',
            'experiences.*.position'      => 'required|string|max:100',
            'experiences.*.start_date'    => 'required|date',
            'experiences.*.end_date'      => 'nullable|date|after_or_equal:experiences.*.start_date',
            'experiences.*.description'   => 'nullable|string|max:255',
        ];
    }

    private function availabilityRules(): array
    {
        return [
            'is_available'     => 'required|boolean',
            'available_days'   => 'nullable|array',
            'available_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'available_from'   => 'nullable|date',
            'available_to'     => 'nullable|date|after_or_equal:available_from',
            'start_time'       => 'nullable|date_format:H:i',
            'end_time'         => 'nullable|date_format:H:i|after:start_time',
            'slot_duration'    => 'nullable|integer|min:5|max:240',
            'recurrence'       => 'required|in:none,daily,weekly',
            'blocked_dates'    => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return array_merge(
            $this->basicInfoMessages(),
            $this->specializationMessages(),
            $this->experienceMessages(),
            $this->availabilityMessages()
        );
    }

    private function basicInfoMessages(): array
    {
        return [
                'name.required'         => 'Please enter the doctor\'s first name.',
                'name.max'              => 'First name may not exceed 100 characters.',
                
                'last_name.required'    => 'Please enter the doctor\'s last name.',
                'last_name.max'         => 'Last name may not exceed 100 characters.',

                'email.required'        => 'Email is required.',
                'email.email'           => 'Please enter a valid email address.',
                'email.unique'          => 'This email is already associated with another user.',

                'password.required'     => 'A password is required.',
                'password.min'          => 'Password must be at least 6 characters.',
                'password.confirmed'    => 'Password confirmation does not match.',

                'gender.required'       => 'Please select a gender.',
                'gender.in'             => 'Gender must be Male, Female, or Other.',

                'phone.required'        => 'Phone number is required.',
                'phone.max'             => 'Phone number may not exceed 20 characters.',

                'about_me.required'     => 'Please provide some information about the doctor.',
                'about_me.max'          => 'About Me must not exceed 500 characters.',

                'license_number.max'    => 'License number may not exceed 50 characters.',
                'npi.max'               => 'NPI may not exceed 50 characters.',

                'profile_photo.required'=> 'Please upload a profile photo.',
                'profile_photo.image'   => 'The uploaded file must be an image.',
                'profile_photo.mimes'   => 'Profile photo must be in JPG, JPEG, or PNG format.',
                'profile_photo.max'     => 'Profile photo size must be under 2MB.',
        ];
    }

    private function specializationMessages(): array
    {
        return [
            'specializations.required'   => 'Please select at least one specialization.',
            'specializations.array'      => 'Specializations must be an array.',
            'specializations.*.required' => 'Each specialization must be filled in.',
            'specializations.*.max'      => 'Specialization may not exceed 100 characters.',
        ];
    }

    private function experienceMessages(): array
    {
        return [
            'experiences.*.hospital_name.required' => 'Hospital name is required for each experience.',
            'experiences.*.address.required'       => 'Address is required for each experience.',
            'experiences.*.position.required'      => 'Position is required for each experience.',
            'experiences.*.start_date.required'    => 'Start date is required for each experience.',
            'experiences.*.start_date.date'        => 'Start date must be a valid date.',
            'experiences.*.end_date.date'          => 'End date must be a valid date.',
            'experiences.*.end_date.after_or_equal'=> 'End date must be after the start date.',
            'experiences.*.description.max'        => 'Experience description may not exceed 255 characters.',
        ];
    }

    private function availabilityMessages(): array
    {
        return [
            'is_available.required'      => 'Please specify if the doctor is available for appointments.',
            'is_available.boolean'       => 'Availability must be true or false.',
            'available_days.*.in'        => 'Each selected day must be a valid weekday.',
            'available_from.date'        => 'Available from must be a valid date.',
            'available_to.date'          => 'Available to must be a valid date.',
            'available_to.after_or_equal'=> 'Available to must be the same or after Available from.',
            'start_time.date_format'     => 'Start time must be in HH:MM format.',
            'end_time.date_format'       => 'End time must be in HH:MM format.',
            'end_time.after'             => 'End time must be after start time.',
            'slot_duration.integer'      => 'Slot duration must be a number.',
            'slot_duration.min'          => 'Slot duration must be at least 5 minutes.',
            'slot_duration.max'          => 'Slot duration may not exceed 240 minutes.',
            'recurrence.in'              => 'Invalid recurrence pattern.',
        ];
    }
} 