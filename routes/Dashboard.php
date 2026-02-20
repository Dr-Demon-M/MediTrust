<?php

use App\Http\Controllers\Dashboard\AvailabilityController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SpecialtyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('doctors/availability-schedule', [AvailabilityController::class, 'availabilitySchedule'])->name('availability-schedule.index');
    Route::get('doctors/availability-schedule/{slug}', [AvailabilityController::class, 'showAvailabilitySchedule'])->name('availability-schedule.show');
    Route::delete('doctors/availability-schedule/{slug}', [AvailabilityController::class, 'deleteAvailabilitySchedule'])->name('availability-schedule.delete');
    Route::post('availability-schedule/exception/{slug}', [AvailabilityController::class, 'addAvailabilitySchedule'])->name('availability-schedule.add');
    Route::get('specialties/{slug}/new-appointment', [SpecialtyController::class, 'showNewAppointmentForm'])->name('specialties.new-appointment');
    Route::resource('specialties', SpecialtyController::class);
    Route::resource('doctors', DoctorController::class);
});
