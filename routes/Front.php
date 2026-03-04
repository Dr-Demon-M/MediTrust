<?php

use App\Http\Controllers\Front\AppointmentController;
use App\Http\Controllers\Front\DepartmentController;
use App\Http\Controllers\Front\DoctorController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Route;

Route::name('front.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::view('/about', 'front.more.about')->name('about.index');

    Route::view('/faq', 'front.more.faq')->name('faq.index');

    Route::view('/terms', 'front.more.terms')->name('terms.index');

    Route::view('/privacy', 'front.more.privacy')->name('privacy.index');

    Route::view('/error-404', 'front.more.error')->name('error.index');

    Route::resource('departments', DepartmentController::class);

    Route::resource('services', ServiceController::class);

    Route::resource('doctors', DoctorController::class);

    Route::resource('appointments', AppointmentController::class);
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});
