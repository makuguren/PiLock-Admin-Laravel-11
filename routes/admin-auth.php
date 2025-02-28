<?php

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {

    // Check if the Configuration is Allow to Logged In and Register
    $appSetting = View::shared('appSetting');

    if($appSetting->isRegAdmins == '1'){
        Route::get('register', [RegisteredAdminController::class, 'create'])
        ->name('register');

        Route::post('register', [RegisteredAdminController::class, 'store']);
    }

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
