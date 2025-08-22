<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Patient\AuthenticationController;
use App\Http\Controllers\Api\Patient\PatientProfileController;
use App\Http\Controllers\Api\Doctor\DoctorController;
use App\Http\Controllers\Api\Doctor\DoctorScheduleController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\Appointment\AppointmentController;
use App\Http\Controllers\Api\EnquireFormController;
use App\Http\Controllers\Api\Payment\PaymentController;

use App\Http\Controllers\Api\Patient\ForgotPasswordController;
use App\Http\Controllers\Api\Patient\ResetPasswordController;

Route::get('/protected-image/{filename}', [ImageController::class, 'show'])
    ->where('filename', '.*');

Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/refresh-token', [AuthenticationController::class, 'refreshToken']);

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);


Route::middleware('auth:api')->group(function () {
    
Route::post('/logout', [AuthenticationController::class, 'logout']);
Route::get('/detail', [AuthenticationController::class,'getUser']);
Route::post('/user/payments', [AuthenticationController::class,'payments']);
Route::post('/profile/update', [PatientProfileController::class, 'upsert']);
Route::post('/appointments', [AppointmentController::class, 'getPatientAppointments']);
Route::get('/appointment/{id}', [AppointmentController::class, 'show']);


Route::get('/intake-form', [AppointmentController::class, 'intakeGet']);

    // Route::get('/protected-image/{filename}', [ImageController::class, 'show'])->where('filename', '.*')->name('protected-image');

});


/**
 * Guest Routes 
 * */

   Route::post('/payment-intent', [PaymentController::class, 'createPaymentIntent']);
   Route::post('/appointment/add', [AppointmentController::class, 'store']);
   Route::post('/intake-form/add', [AppointmentController::class, 'intakeStore']);




/**
 * Doctors
 *
 * */


Route::get('/doctors', [DoctorController::class, 'index']);

Route::get('/doctor/{id}', [DoctorController::class, 'show']);

Route::post('/doctors/available-dates', [DoctorScheduleController::class, 'availableDates']);
Route::post('/doctors/available-slots', [DoctorScheduleController::class, 'availableSlots']);

Route::post('/enquire', [EnquireFormController::class, 'store']);