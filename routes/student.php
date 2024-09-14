<?php

use App\Livewire\Student\Dashboard;
use App\Livewire\Student\Profile\ProfileIndex;
use Illuminate\Support\Facades\Route;

Route::middleware('isStudent')->as('student.')->prefix('student')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    Route::as('student.')->prefix('students')->group(function () {
        // Route::get('', ProfileIndex::class)->name('index');
    });
});
