<?php
namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\RegisterRequest;
use App\Http\Requests\Api\Patient\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\User\PatientRegisteredNotification;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $user->assignRole('patient');

    
        $tokenResponse = Http::asForm()->post(config('app.url') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*',
        ]);

        if ($tokenResponse->failed()) {
            return response()->json([
                'status' => false,
                'message' => 'User registered, but token could not be generated.',
            ], 500);
        }

        $user->notify(new PatientRegisteredNotification($user));
        
        return response()->json([
            'status' => true,
            'message' => 'Patient registered successfully.',
            'data' => [
                'user' => [
                    'first_name'  => $user->name,
                    'last_name'  => $user->last_name,
                    'email' => $user->email,
                ],
                'token' => $tokenResponse->json()
            ]
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        if ($user->getRoleNames()->first() !== 'patient') {
            return response()->json([
                'status' => false,
                'message' => 'Access denied. Not a valid patient user.',
            ], 403);
        }



        $tokenResponse = Http::asForm()->post(config('app.url') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*',
        ]);

        if ($tokenResponse->failed()) {
            return response()->json([
                'status' => false,
                'message' => 'Token generation failed.',
                'details' => $tokenResponse->body(), 
            ], $tokenResponse->status());
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                 'user' => [
                    'first_name'  => $user->name,
                    'last_name'  => $user->last_name,
                    'email' => $user->email,
                ],   
                'token' => $tokenResponse->json(),
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $token = $user?->token();

        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or missing token.',
            ], 400);
        }

        $token->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Patient logged out successfully',
        ], 200);
    }



    public function getUser(Request $request)
    {
        $user = $request->user()->load('patientProfile');
        return response()->json([
            'status' => true,
            'data' => $user,
        ], 200);
    }


     public function payments(Request $request)
    {
         $payments = $request->user()->payments()->latest()->get()->makeHidden('meta');
        return response()->json([
            'status' => true,
            'data' => $payments,
        ], 200);
    }


    public function refreshToken(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $refreshResponse = Http::asForm()->post(config('app.url') . '/oauth/token', [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id'     => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'scope'         => '*',
        ]);

        if ($refreshResponse->successful()) {
            return response()->json($refreshResponse->json(), 200);
        }

        return response()->json([
            'message' => 'Could not refresh token',
            'error' => $refreshResponse->json(),
        ], 401);
    }



}