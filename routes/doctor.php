<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/doctor/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:doctor'])->name('doctor.dashboard');

Route::middleware(['auth','role:doctor'])->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});