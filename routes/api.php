<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\User\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;


Route::name('auth.')->group(function () {
    // Public routes
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login');

    Route::prefix('email')->middleware('auth:sanctum')->name('email.')->group(function () {
        Route::post('verify', [AuthController::class, 'verifyEmail'])->middleware('throttle:10,10')->name('verify');
        Route::post('send-otp', [AuthController::class, 'sendEmailOtp'])->middleware('throttle:10,10')->name('send-otp');
    });

    Route::prefix('password')->middleware('auth:sanctum')->name('password.')->group(function () {
        Route::post('send-otp', [PasswordController::class, 'sendOtp'])->middleware('throttle:10,10')->name('send-otp');
        Route::post('verify', [PasswordController::class, 'verify'])->middleware('throttle:10,10')->name('verify');
        Route::post('reset', [PasswordController::class, 'reset'])->middleware('throttle:10,10')->name('reset');
    });

    Route::post('social/{provider}', [SocialLoginController::class, 'getUrl']);
    Route::post('social/{provider}/callback', [SocialLoginController::class, 'handleCallback']);
});


// Candidate routes
Route::middleware(['auth:sanctum','role:candidate', 'verified'])->group(base_path('routes/candidate.php'));

// Company routes
Route::middleware(['auth:sanctum','role:company', 'verified'])->group(base_path('routes/company.php'));

// Admin routes
Route::middleware(['auth:sanctum','role:admin'])->group(base_path('routes/admin.php'));



// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('me', [AuthController::class, 'me'])->name('me');
});
