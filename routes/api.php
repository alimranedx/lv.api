<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/index', function () {
    return response()->json(['message' => 'Hello World']);
});
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login-step1', [AuthController::class, 'loginStepOne']);
Route::post('/login-step2', [AuthController::class, 'loginStepTwo']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
    Route::get('/home', function () {
        return response()->json([
            'message' => 'Welcome home!',
            'user' => auth()->user()
        ]);
    });
});

