<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\PatientProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PatientProfileController extends Controller
{
    public function upsert(PatientProfileRequest $request)
    {
        $user = auth()->user();
        $validated = $request->validated();

        $this->handleProfileImage($user, $request, $validated);
        $this->updateUserFields($user, $validated);
        $user->save();

        $profileData = $this->prepareProfileData($validated);
        $profile = $this->upsertPatientProfile($user, $profileData);

        $imageUrl = $profile->profile_image
        ? Storage::url("patient/profile/{$profile->profile_image}")
        : null;
        return response()->json([
            'status' => true,
            'message' => 'Profile Saved Successfully.',
            'data' => [
                'user' => $user->only(['id', 'name', 'last_name', 'email']),
                'profile' => array_merge(
                    $profile->toArray(),
                    ['image_url' => $imageUrl]
                ),
            ],
        ],200);
    }

    protected function handleProfileImage($user, $request, &$validated)
    {
        if ($request->hasFile('image')) {
            Log::info('Image upload detected for user ID: ' . $user->id);

            if ($user->patientProfile && $user->patientProfile->profile_image) {
                Log::info('Deleting existing image at: ' . $user->patientProfile->profile_image);
                Storage::delete($user->patientProfile->profile_image);
            }

            $path = $request->file('image')->store('patient/profile','public'); 
            $validated['profile_image'] = basename($path);

            Log::info('New image stored at: ' . $path);
        } else {
            Log::info('No image file provided for user ID: ' . $user->id);
        }
    }

    protected function updateUserFields($user, $validated)
    {
        if (!empty($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (!empty($validated['first_name'])) {
            $user->name = $validated['first_name'];
        }

        if (!empty($validated['last_name'])) {
            $user->last_name = $validated['last_name'];
        }

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
    }

    protected function prepareProfileData(array $validated)
    {
        return [
            'date_of_birth'   => $validated['date_of_birth'],
            'gender'          => $validated['gender'],
            'phone_number'    => $validated['phone_number'],
            'height_cm'       => $validated['height_cm'] ?? null,
            'height_feet'     => $validated['height_feet'] ?? null,
            'height_inches'   => $validated['height_inches'] ?? null,
            'weight_lbs'      => $validated['weight_lbs'] ?? null,
        ];

    }

    protected function upsertPatientProfile($user, $profileData)
    {
        return $user->patientProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );
    }


     public function payments(): JsonResponse
    {
        $payments = auth()->user()->payments()->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $payments
        ], 200);
    }



}
