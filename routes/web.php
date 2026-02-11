<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    //Route::view('/homepage', 'homepage')->name('homepage');

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::view('/schedule', 'dashboard');
    Route::view('/tasks', 'dashboard');
    Route::view('/progress', 'dashboard');
    Route::view('/subjects', 'dashboard');
    Route::view('/notes', 'dashboard');
    Route::view('/habits', 'dashboard');
    Route::view('/achievements', 'dashboard');
    Route::view('/resources', 'dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
