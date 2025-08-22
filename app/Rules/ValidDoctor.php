<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;
use App\Models\Doctor\Doctor;

class ValidDoctor implements Rule
{
    public function passes($attribute, $value): bool
    {
        // Try to load the related user through the doctor model
        $doctor = Doctor::find($value);

        if (!$doctor || !$doctor->user) {
            return false;
        }

        $user = $doctor->user;

        return $user->hasRole('doctor');
    }

    public function message(): string
    {
        return 'The selected user is not a valid doctor with a profile.';
    }
}
