<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
<<<<<<< HEAD
use App\Http\Controllers\Admin\UserController;
=======
use App\Http\Controllers\Scheduler\ScheduleController;


>>>>>>> 6019a331c7016c4385196aa0e8c66cbb60bd80f9

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

<<<<<<< HEAD
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});
Route::patch('/admin/users/{user}/toggle', [UserController::class, 'toggleActive'])->name('users.toggle');

=======


     Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create'); // Show form
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store'); // Handle form submission


});
>>>>>>> 6019a331c7016c4385196aa0e8c66cbb60bd80f9
