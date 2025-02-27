<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('users', UserController::class);
    Route::post('users/make-doctor/{id}', [UserController::class, 'convertUserToDoctor'])->name('users.make-doctor');
    Route::resource('doctors', DoctorController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::get('doctors/{id}/schedules', [DoctorController::class, 'schedules'])->name('doctors.schedules');
});
