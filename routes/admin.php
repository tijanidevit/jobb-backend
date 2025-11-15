<?php

use App\Modules\Admin\Controllers\AdminController;
use App\Modules\Company\Controllers\CompanyController;
use App\Modules\Jobs\Controllers\VacancyController;
use App\Modules\Applications\Controllers\VacancyApplicationController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Companies
    Route::prefix('companies')->name('companies.')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        Route::post('{id}/verify', [CompanyController::class, 'verify'])->name('verify');
    });

    // Jobs
    Route::prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', [VacancyController::class, 'index'])->name('index');
    });

    // Applicants
    Route::prefix('applicants')->name('applicants.')->group(function () {
        Route::get('/', [VacancyApplicationController::class, 'index'])->name('index');
    });
});
