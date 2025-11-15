<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;


Route::name('auth.')->group(function () {
    // Public routes
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::post('verify-email', [AuthController::class, 'verifyEmail']);
    Route::post('send-otp', [AuthController::class, 'sendOtp']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('social/{provider}', [SocialLoginController::class, 'getUrl']);
    Route::post('social/{provider}/callback', [SocialLoginController::class, 'handleCallback']);
});


// Candidate routes
Route::middleware(['auth:sanctum','role:candidate'])->group(base_path('routes/candidate.php'));

// Company routes
Route::middleware(['auth:sanctum','role:company'])->group(base_path('routes/company.php'));

// Admin routes
Route::middleware(['auth:sanctum','role:admin'])->group(base_path('routes/admin.php'));



// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('me', [AuthController::class, 'me'])->name('me');
});
