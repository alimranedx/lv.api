<?php


use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);

Route::post('/individual-login', [AuthController::class, 'individualLogin']);
Route::post('/sms-verify', [AuthController::class, 'smsVerify']);

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

