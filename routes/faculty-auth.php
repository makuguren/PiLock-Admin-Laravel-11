<?php

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Faculty\ProfileController;
use App\Http\Controllers\Faculty\Auth\PasswordController;
use App\Http\Controllers\Faculty\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Faculty\Auth\RegisteredFacultyController;

Route::middleware('guest:faculty')->prefix('faculty')->name('faculty.')->group(function () {

    // Check if the Configuration is Allow to Logged In and Register
    $appSetting = View::shared('appSetting');

    if($appSetting->isRegInst == '1'){
        Route::get('register', [RegisteredFacultyController::class, 'create'])
        ->name('register');

        Route::post('register', [RegisteredFacultyController::class, 'store']);
    }

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:faculty')->prefix('faculty')->name('faculty.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
