<?php

use App\Modules\Company\Controllers\CompanyController;
use App\Modules\Jobs\Controllers\VacancyController;
use App\Modules\Applications\Controllers\VacancyApplicationController;
use Illuminate\Support\Facades\Route;

// Company Routes
Route::prefix('company')->name('company.')->group(function () {
    // Dashboard & Profile
    Route::get('dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [CompanyController::class, 'profile'])->name('profile.show');
    Route::post('profile/update', [CompanyController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/upload-logo', [CompanyController::class, 'uploadLogo'])->name('profile.uploadLogo');
    Route::post('profile/upload-verification', [CompanyController::class, 'uploadVerification'])->name('profile.uploadVerification');

    // Jobs
    Route::prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', [VacancyController::class, 'index'])->name('index');
        Route::get('{id}', [VacancyController::class, 'show'])->name('show');
        Route::post('/', [VacancyController::class, 'store'])->name('store');
        Route::post('{id}/update', [VacancyController::class, 'update'])->name('update');
        Route::delete('{id}', [VacancyController::class, 'destroy'])->name('destroy');
        Route::post('{id}/toggle', [VacancyController::class, 'toggle'])->name('toggle');

        // Applicants per Job
        Route::get('{jobId}/applicants', [VacancyApplicationController::class, 'index'])->name('applicants.index');
        Route::get('{jobId}/applicants/{applicationId}', [VacancyApplicationController::class, 'show'])->name('applicants.show');
    });

    // Applications actions
    Route::prefix('applications')->name('applications.')->group(function () {
        Route::post('{id}/update-status', [VacancyApplicationController::class, 'updateStatus'])->name('updateStatus');
        Route::post('{id}/reject', [VacancyApplicationController::class, 'reject'])->name('reject');
        Route::post('{id}/offer-letter', [VacancyApplicationController::class, 'sendOffer'])->name('sendOffer');
    });
});
