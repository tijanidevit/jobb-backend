<?php

use App\Http\Controllers\Candidate\DashboardController;
use App\Http\Controllers\Candidate\ProfileController;
use App\Http\Controllers\Candidate\VacancyController;
use Illuminate\Support\Facades\Route;

// Candidate Routes
Route::prefix('candidate')->name('candidate.')->group(function () {

    // Dashboard
    Route::get('dashboard', DashboardController::class)->name('dashboard');


    // Profile
    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::patch('', 'updateProfile')->name('update');
    });



    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // Resumes
    Route::prefix('resumes')->name('resumes.')->group(function () {
        Route::get('', [CandidateResumeController::class, 'index'])->name('index');
        Route::post('', [CandidateResumeController::class, 'store'])->name('store');
        Route::post('{id}/update', [CandidateResumeController::class, 'update'])->name('update');
        Route::delete('{id}', [CandidateResumeController::class, 'destroy'])->name('destroy');
    });


    // Jobs
    Route::prefix('vacancies')->name('vacancy.')->group(function () {
        Route::get('', [VacancyController::class, 'index'])->name('index');
        Route::get('{slug}', [VacancyController::class, 'show'])->name('show');
        Route::post('{id}/apply', [VacancyController::class, 'apply'])->name('apply');
        Route::post('{id}/save', [VacancyController::class, 'save'])->name('save');
        Route::get('saved', [VacancyController::class, 'saved'])->name('saved');
    });
});
