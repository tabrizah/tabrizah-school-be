<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemLogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logs', [SystemLogController::class, 'index'])->middleware('permission:view-logs');
    Route::get('logs/{id}', [SystemLogController::class, 'show'])->middleware('permission:view-logs');
});

// Create api testing route for test event EventUserAuthenticated
Route::get('test-event', function () {
    $user = \App\Models\User::find(1);
    $token = $user->createToken('test-token')->plainTextToken;
    event(new \App\Events\EventUserAuthenticated(null, $token, ['test' => 'test']));
    return response()->json(['message' => 'Event dispatched']);
});