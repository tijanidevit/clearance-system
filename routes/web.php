<?php

use App\Livewire\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->middleware('guest')->name('login');

Route::middleware('auth')->group(function () {
    include __DIR__.'/admin.php';
    include __DIR__.'/moderator.php';
    include __DIR__.'/student.php';


    Route::get('logout', function () {
        Auth::logout();
        return to_route('login');
    })->name('logout');
});
