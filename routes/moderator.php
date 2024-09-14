<?php

use App\Livewire\Moderator\Dashboard;
use App\Livewire\Moderator\Student\StudentIndex;
use Illuminate\Support\Facades\Route;

Route::middleware('isModerator')->as('moderator.')->prefix('moderator')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    Route::as('student.')->prefix('students')->group(function () {
        Route::get('', StudentIndex::class)->name('index');
    });
});
