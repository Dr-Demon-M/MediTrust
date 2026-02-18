<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Tasks Route
Route::apiResource('Task',TaskController::class)->middleware(['auth:sanctum','Checkuser']);

Route::middleware('auth:sanctum')->group(function () {
    
    // Tasks by id 
    Route::post('Task',[TaskController::class, 'store'])->middleware('auth:sanctum');
    Route::get('Task',[TaskController::class, 'getusertask'])->middleware('auth:sanctum');
});
    Route::put('Task/{id}',[TaskController::class, 'addtasktocategory']);


// Profile Route
Route::prefix('/profile')->group( function() {

    Route::post('', [ProfileController::class, 'store'])->middleware('auth:sanctum');
    Route::get('', [ProfileController::class, 'index']);
    Route::get('/{id}', [ProfileController::class, 'getoneprofile']);
    Route::put('', [ProfileController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('', [ProfileController::class, 'destroy'])->middleware('auth:sanctum')   ;

});


// User Route
Route::post('register', [UserController::class, 'register']);
Route::get('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// fav tasks 
Route::post('task/{id}/fav', [TaskController::class, 'addtofav'])->middleware('auth:sanctum');
Route::delete('task/{id}/fav', [TaskController::class, 'removefromfav'])->middleware('auth:sanctum');
Route::get('task/fav', [TaskController::class, 'showallfav'])->middleware('auth:sanctum');