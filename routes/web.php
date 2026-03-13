<?php

use App\Http\Controllers\Front\DoctorController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:patient')->group(function () {
    Route::get('/profile/security', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/FrontAuth.php';
require __DIR__ . '/Dashboard.php';
require __DIR__ . '/Front.php';
