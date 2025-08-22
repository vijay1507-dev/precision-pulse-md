<?php
namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor\Doctor;
use Illuminate\Support\Facades\Cache;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::role('doctor')
            ->whereHas('doctor')
            ->with('doctor') 
            ->select('id', 'name', 'last_name', 'email')
            ->get()
            ->map(function ($doc) {
                $doctorProfile = $doc->doctor;

                return [
                    'id'                => $doctorProfile->id,
                    'doctor_id'         => $doctorProfile->id,
                    'name'              => trim("{$doc->name} {$doc->last_name}"),
                    'email'             => $doc->email,
                    'gender'            => $doctorProfile?->gender,
                    'phone'             => $doctorProfile?->phone,
                    'about_me'          => $doctorProfile?->about_me,
                    'license_number'    => $doctorProfile?->license_number,
                    'npi'               => $doctorProfile?->npi,
                    'specializations'   => $doctorProfile?->specializations ?? [],
                    'profile_photo'     => $doctorProfile?->profile_photo,
                ];
            });

        return response()->json([
            'status'  => true,
            'message' => 'Doctor list fetched successfully.',
            'data'    => $doctors
        ]);
    }


   public function show($doctorId)
{
    $cacheKey = "doctor_profile_{$doctorId}";

    $responseData = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($doctorId) {
        $doctor = Doctor::with(['user:id,name,last_name,email', 'experiences:id,doctor_id,hospital_name,address,position,start_date,end_date,description'])
            ->select('id', 'user_id', 'gender', 'phone', 'about_me', 'license_number', 'npi', 'specializations', 'profile_photo')
            ->find($doctorId);

        if (!$doctor || !$doctor->user) {
            return null;
        }

        $user = $doctor->user;

        return [
            'id'              => $doctor->id,
            'name'            => trim("{$user->name} {$user->last_name}"),
            'email'           => $user->email,
            'gender'          => $doctor->gender,
            'phone'           => $doctor->phone,
            'about_me'        => $doctor->about_me,
            'license_number'  => $doctor->license_number,
            'npi'             => $doctor->npi,
            'specializations' => $doctor->specializations ?? [],
            'profile_photo'   => $doctor->profile_photo,
            'experiences'     => $doctor->experiences->map(function ($exp) {
                return [
                    'hospital_name' => $exp->hospital_name,
                    'address'       => $exp->address,
                    'position'      => $exp->position,
                    'start_date'    => $exp->start_date,
                    'end_date'      => $exp->end_date,
                    'description'   => $exp->description,
                ];
            }),
        ];
    });

    if (!$responseData) {
        return response()->json([
            'status'  => false,
            'message' => 'Doctor not found.'
        ], 404);
    }

    return response()->json([
        'status'  => true,
        'message' => 'Doctor profile fetched successfully (cached).',
        'data'    => $responseData
    ]);
}


}
