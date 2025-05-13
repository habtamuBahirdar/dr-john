<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Scheduler\ScheduleController;



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



     Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create'); // Show form
         Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index'); // List all schedules

    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store'); // Handle form submission
    Route::get('/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit'); // Edit schedule
    Route::put('/schedules/{id}', [ScheduleController::class, 'update'])->name('schedules.update'); // Update schedule
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy'); // Delete schedule



});