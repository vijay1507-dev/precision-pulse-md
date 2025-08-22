<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment\Appointment;
use App\Models\Appointment\IntakeForm;

class AppointmentController extends Controller
{
    
    public function index()
    {
         $sortDirection = request('sort', 'asc'); 

         $appointments = Appointment::withFullDetails($sortDirection)
        ->paginate(10)
        ->appends(['sort' => $sortDirection]);

        return view('admin.appointment.index', compact('appointments'));
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        return view('admin.appointment.edit', compact('appointment'));
    }


    
    

    
}
