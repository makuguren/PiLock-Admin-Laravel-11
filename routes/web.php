<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//User Interface
Route::get('/socialite/google', [SocialLoginController::class, 'toProvider'])->name('socialite.login');
Route::get('/auth/google/login', [SocialLoginController::class, 'handleCallback'])->name('auth.google.login');

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/instructor-auth.php';
