<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemLogController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logs', [SystemLogController::class, 'index'])->middleware('permission:view-logs');
    Route::get('logs/{id}', [SystemLogController::class, 'show'])->middleware('permission:view-logs');
});

// create testing route to check if the user token is not expired
Route::get('test-token', function () {
    return response()->json(['message' => 'Token is valid']);
})->middleware('auth:sanctum');



// Create api testing route for test event EventUserAuthenticated
Route::get('test-event', function () {
    $user = \App\Models\User::find(1);
    $token = $user->createToken('test-token')->plainTextToken;
    event(new \App\Events\EventUserAuthenticated(null, $token, ['test' => 'test']));
    return response()->json(['message' => 'Event dispatched']);
});