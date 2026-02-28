<?php

use App\Http\Controllers\Dashboard\AppointmentController;
use App\Http\Controllers\Dashboard\AvailabilityController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SpecialtyController;
use App\Http\Controllers\TodoController;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/notifications/{notification}/read/{appointment}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::get('availability', [AvailabilityController::class, 'availabilitySchedule'])->name('availability-schedule.index');
    Route::get('availability/{slug}', [AvailabilityController::class, 'showAvailabilitySchedule'])->name('availability-schedule.show');
    Route::delete('availability/{slug}', [AvailabilityController::class, 'deleteAvailabilitySchedule'])->name('availability-schedule.delete');

    Route::get('profile/edit', [DoctorController::class, 'docProfile2'])->name('doc.profile.edit');
    Route::get('complete-profile', [DoctorController::class, 'docProfile'])->name('doctors.complete-profile');
    Route::resource('doctors', DoctorController::class);

    Route::post('availability-schedule/exception/{slug}', [AvailabilityController::class, 'addAvailabilitySchedule'])->name('availability-schedule.add');

    Route::get('specialties/{slug}/new-appointment', [SpecialtyController::class, 'showNewAppointmentForm'])->name('specialties.new-appointment');

    Route::resource('specialties', SpecialtyController::class);


    Route::get('services/featured', [ServiceController::class, 'featured'])->name('services.featured');
    Route::post('/services/featured', [ServiceController::class, 'updateFeatured'])
        ->name('services.update');
    Route::resource('services', ServiceController::class);

    Route::get('appointments/pending', [AppointmentController::class, 'pending'])->name('appointments.pending');
    Route::get('appointments/today', [AppointmentController::class, 'today'])->name('appointments.today');
    Route::get('appointments/completed/{id}', [AppointmentController::class, 'complete'])->name('appointment.completed');
    Route::get('appointments/confirmed/{id}', [AppointmentController::class, 'confirm'])->name('appointment.confirmed');
    Route::get('appointments/canceled/{id}', [AppointmentController::class, 'cancel'])->name('appointment.canceled');
    Route::resource('appointments', AppointmentController::class);

    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::patch('/todos/{todo}', [TodoController::class, 'toggle'])->name('todos.toggle');
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');

    Route::get('patients/consultation', [PatientController::class, 'consultation'])->name('patients.consultation');
    Route::resource('patients', PatientController::class);
    // Route::view('patients', 'dashboard.patients.index')->name('patients.index');

    Route::get('/api/specialties/{id}/services', function ($id) {
        return Service::where('specialty_id', $id)->get();
    });
    Route::get('/api/specialties/{id}/doctors', function ($id) {
        return Doctor::where('specialty_id', $id)->get(['id', 'name']);
    });
});
