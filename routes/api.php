<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CardController;

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']); // Get all users
    Route::post('/', [UserController::class, 'store']); // Create a new user
    Route::get('/{id}', [UserController::class, 'show']); // Get a specific user
    Route::put('/{id}', [UserController::class, 'update']); // Update a specific user
    Route::delete('/{id}', [UserController::class, 'destroy']); // Delete a specific user
});

Route::prefix('teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index']);
    Route::post('/', [TeacherController::class, 'store']);
    Route::get('/{id}', [TeacherController::class, 'show']);
    Route::put('/{id}', [TeacherController::class, 'update']);
    Route::delete('/{id}', [TeacherController::class, 'destroy']);
});

Route::prefix('classes')->group(function () {
    Route::get('/', [ClassesController::class, 'index']);
    Route::post('/', [ClassesController::class, 'store']);
    Route::get('/{id}', [ClassesController::class, 'show']);
    Route::put('/{id}', [ClassesController::class, 'update']);
    Route::delete('/{id}', [ClassesController::class, 'destroy']);
});

Route::prefix('student')->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::post('/', [StudentController::class, 'store']);
    Route::get('/{id}', [StudentController::class, 'show']);
    Route::put('/{id}', [StudentController::class, 'update']);
    Route::delete('/{id}', [StudentController::class, 'destroy']);
});

Route::prefix('card')->group(function () {
    Route::get('/', [CardController::class, 'index']);
    Route::post('/', [CardController::class, 'store']);
    Route::get('/{id}', [CardController::class, 'show']);
    Route::put('/{id}', [CardController::class, 'update']);
    Route::delete('/{id}', [CardController::class, 'destroy']);
});

Route::prefix('attendance')->group(function () {
    Route::get('/', [CardController::class, 'index']);
    Route::post('/checkin', [CardController::class, 'store']);
});