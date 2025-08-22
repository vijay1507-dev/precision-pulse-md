<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Doctor\DoctorController;

use App\Http\Controllers\Patient\PatientController;


// Authenticated admins
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminProfileController::class, 'index'])->name('dashboard');
    Route::post('/profile/save/{id?}', [AdminProfileController::class, 'save'])->name('profile.save');
    Route::get('/profile', [AdminProfileController::class, 'viewSelf'])->name('profile');
    

    /**
     * Admin Appointments Routes 
     * 
     * */
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('/appointment/{id}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');

    Route::get('/appointment-add', function () {
            return view('admin.appointment.add-appointment');
        })->name('add-appointment');

    Route::get('/appointment-detail', function () {
            return view('admin.appointment.appointment-detail');
        })->name('appointment-detail');


 /**
  *
  * Admin Doctors Routes 
  *
  * */

 Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors');
 Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctor.show');
 Route::post('/doctors/create', [DoctorController::class, 'store'])->name('doctor.create');
 Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
 Route::put('/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctor.update');
 Route::get('/add-doctor', function () { return view('admin.doctors.add'); })->name('add-doctor');



 /**
  *
  * Admin Patient Routes 
  *
  * */

Route::get('/patients',function () { return view('admin.patient.index'); })->name('patients');


Route::get('/add-patient',function () { return view('admin.patient.add'); })->name('patient.add');
Route::post('/patient/create',[PatientController::class, 'register'])->name('patient.create');
// Route::get('/patient/{id}/edit', [PatientController::class, 'edit'])->name('patient.edit');
// Route::put('/patient/{id}', [PatientController::class, 'update'])->name('patient.update');




Route::get('/revenue',function () { return view('admin.revenue'); })->name('revenue');

 /**
  *
  * Admin Settings Routes 
  *
  * */
Route::get('/pactice-info-setting',function () { return view('admin.setting.practiceInfo'); })->name('setting.pacticeinfo');
Route::get('/telehealth-setting',function () { return view('admin.setting.telehealth'); })->name('setting.telehealth');
Route::get('/payment-setting',function () { return view('admin.setting.payments'); })->name('setting.payments');
Route::get('/notification-setting',function () { return view('admin.setting.notifications'); })->name('setting.notifications');



});
