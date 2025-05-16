<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Scheduler\ScheduleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;






Route::get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/home');
    })->name('home');
});
Route::resource('blogs', BlogController::class);
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::delete('blogs/{blog}/delete-image/{imageIndex}', [BlogController::class, 'deleteImage'])->name('blogs.deleteImage');

Route::patch('/admin/users/{user}/toggle', [UserController::class, 'toggleActive'])->name('users.toggle');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
route::get('/home', [AdminController::class, 'index']);

Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
Route::get('/admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('patients', [App\Http\Controllers\Admin\PatientController::class, 'index'])->name('patients.index');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/patient', [AdminController::class, 'index'])->name('patient.index');


    // Appointments Routes
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/pay', [AppointmentController::class, 'pay'])->name('appointments.pay');
    Route::get('/appointments/callback', [AppointmentController::class, 'callback'])->name('appointments.callback');
    Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show'); // View
    Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit'); // Edit
    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update'); // Update
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy'); // Delete
    Route::post('/appointments/{id}/complete', [AppointmentController::class, 'complete'])->name('appointments.complete');

    // Schedules Routes
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create'); // Show form
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index'); // List all schedules
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store'); // Handle form submission
    Route::get('/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit'); // Edit schedule
    Route::put('/schedules/{id}', [ScheduleController::class, 'update'])->name('schedules.update'); // Update schedule
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy'); // Delete schedule
});

Route::get('/products', function() { return 'Products'; })->name('products.index');
Route::get('/orders', function() { return 'Orders'; })->name('orders.index');
Route::get('/orders/completed', function() { return 'Completed Orders'; })->name('orders.completed');
Route::get('/orders/pending', function() { return 'Pending Orders'; })->name('orders.pending');


Route::resource('products', ProductController::class);

// public products

Route::get('/our-products/{product}', [ProductController::class, 'showPublic'])->name('products.public.show');
Route::get('/our-products', [ProductController::class, 'publicIndex'])->name('products.public');
Route::post('/cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{product}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/payment/callback', [App\Http\Controllers\CartController::class, 'paymentCallback'])->name('cart.payment.callback');