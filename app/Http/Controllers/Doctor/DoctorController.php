<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorExperience;
use App\Models\Doctor\DoctorAvailability;
use Illuminate\Http\Request;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Notifications\User\DoctorRegisteredNotification;



class DoctorController extends Controller
{

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'specialization', 'sort', 'direction']);
        $doctors = Doctor::getFilteredList($filters);

        return view('admin.doctors.index', compact('doctors', 'filters'));
    }

    public function show($id)
    {
        $doctor = Doctor::findFullProfile($id);
        return view('admin.doctors.show', compact('doctor'));
    }

    public function store(StoreDoctorRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {

            $user = User::createDoctorAccount($validated);
            $doctor = Doctor::createFromRequest($validated, $user->id);
            DoctorExperience::bulkStore($validated['experiences'] ?? [], $doctor->id);
            
            DoctorAvailability::storeFromRequest($validated, $doctor->id);

           $user->notify(new DoctorRegisteredNotification($user));

        });

        return redirect()->route('admin.doctors')->with('success', 'Doctor profile created successfully!');
    }

    public function edit(Doctor $doctor)
    {
        $doctor->load(['user', 'availability', 'experiences']);
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $doctor) {

            $doctor->user->updateDoctorUser($validated);

            $doctor->updateFromRequest($validated);

            DoctorExperience::syncFromRequest($validated['experiences'] ?? [], $doctor->id);

            DoctorAvailability::storeFromRequest($validated, $doctor->id);

        });

        return redirect()->route('admin.doctors')->with('success', 'Doctor profile updated successfully!');
    }


    public function create()
    {
        return view('admin.doctor.create');
    }
}
