<?php

use App\Modules\Candidate\Controllers\CandidateController;
use App\Modules\Jobs\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

// Candidate Routes
Route::prefix('candidate')->name('candidate.')->group(function () {
    // Profile
    Route::get('profile', [CandidateController::class, 'profile'])->name('profile.show');
    Route::post('profile/update', [CandidateController::class, 'updateProfile'])->name('profile.update');

    // Resumes
    Route::prefix('resumes')->name('resumes.')->group(function () {
        Route::get('/', [CandidateController::class, 'resumes'])->name('index');
        Route::post('/', [CandidateController::class, 'storeResume'])->name('store');
        Route::post('{id}/update', [CandidateController::class, 'updateResume'])->name('update');
        Route::delete('{id}', [CandidateController::class, 'destroyResume'])->name('destroy');
    });


    // Jobs
    Route::prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', [VacancyController::class, 'index'])->name('index');
        Route::get('{id}', [VacancyController::class, 'show'])->name('show');
        Route::post('{id}/apply', [VacancyController::class, 'apply'])->name('apply');
        Route::post('{id}/save', [VacancyController::class, 'save'])->name('save');
        Route::get('saved', [VacancyController::class, 'saved'])->name('saved');
    });
});
