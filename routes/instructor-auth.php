<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\ProfileController;
use App\Http\Controllers\Instructor\Auth\PasswordController;
use App\Http\Controllers\Instructor\Auth\RegisteredUserController;
use App\Http\Controllers\Instructor\Auth\AuthenticatedSessionController;

Route::middleware('guest:instructor')->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:instructor')->prefix('instructor')->name('instructor.')->group(function () {

    Route::get('/dashboard', function () {
        return view('instructor.dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
