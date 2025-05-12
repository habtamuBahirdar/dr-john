<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


route::get('/home', [AdminController::class, 'index']);



Route::middleware(['auth'])->group(function () {
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
       Route::post('/appointments/pay', [AppointmentController::class, 'pay'])->name('appointments.pay');
    Route::get('/appointments/callback', [AppointmentController::class, 'callback'])->name('appointments.callback');

    Route::get('/patient', [AdminController::class, 'index'])->name('patient.index');
    Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show'); // View
    Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit'); // Edit
    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update'); // Update
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy'); // Delete

});