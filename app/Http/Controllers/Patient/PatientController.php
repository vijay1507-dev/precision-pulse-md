<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Notifications\User\PatientRegisteredNotification;
use App\Http\Requests\Api\Patient\PatientProfileRequest;
use App\Models\User;
use App\Models\Patient\PatientProfile;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientProfile::with('user');

        // Handle search by name, phone, or email
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->orWhere('phone_number', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $patients = $query->orderBy('id', 'desc')->paginate(10);
        
        $patients->appends($request->query());

        return view('admin.patient.index', compact('patients'));
    }
    public function create()
    {
        return view('admin.patient.add');
    }
    public function store(PatientProfileRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request) {
            $user = User::createPatientAccount($validated);

            $profileData = array_merge($validated, ['user_id' => $user->id]);
            $image = $request->file('image');

            PatientProfile::createWithImage($profileData, $image);

            // $user->notify(new PatientRegisteredNotification($user));
        });

        return redirect()->route('admin.patients')->with('success', 'Patient Profile Created successfully!');
    }
}
