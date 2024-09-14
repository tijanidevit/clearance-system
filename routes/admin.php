<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Moderator\ModeratorIndex;
use App\Livewire\Admin\Moderator\ModeratorStore;
use App\Livewire\Admin\Session\SessionIndex;
use App\Livewire\Admin\Session\SessionStore;
use App\Livewire\Admin\Stage\StageIndex;
use App\Livewire\Admin\Stage\StageStore;
use App\Livewire\Admin\Student\StudentIndex;
use App\Livewire\Admin\Student\StudentStore;
use Illuminate\Support\Facades\Route;

Route::middleware('isAdmin')->as('admin.')->prefix('admin')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    Route::as('session.')->prefix('sessions')->group(function () {
        Route::get('', SessionIndex::class)->name('index');
        Route::get('create', SessionStore::class)->name('create');
    });

    Route::as('moderator.')->prefix('moderators')->group(function () {
        Route::get('', ModeratorIndex::class)->name('index');
        Route::get('create', ModeratorStore::class)->name('create');
    });

    Route::as('student.')->prefix('students')->group(function () {
        Route::get('', StudentIndex::class)->name('index');
        Route::get('create', StudentStore::class)->name('create');
    });

    Route::as('stage.')->prefix('stages')->group(function () {
        Route::get('', StageIndex::class)->name('index');
        Route::get('create', StageStore::class)->name('create');
    });

    Route::as('clearance.')->prefix('clearances')->group(function () {
        Route::get('', StudentIndex::class)->name('index');
    });
});
