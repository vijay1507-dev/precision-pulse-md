<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

Route::get('/send-test-mail', function () {
    Mail::to('vikas@stelleninfotech.in')->send(new TestMail());
    return 'Test email sent!';
});
Route::get('/dashboard', [App\Http\Controllers\RedirectController::class, 'dashboardRedirect'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



require __DIR__.'/auth.php';
