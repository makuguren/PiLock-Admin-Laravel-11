<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SocialLoginController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome.index');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//User Interface
Route::middleware('auth:web')->name('user.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/socialite/google', [SocialLoginController::class, 'toProvider'])->name('socialite.login');
Route::get('/auth/google/login', [SocialLoginController::class, 'handleCallback'])->name('auth.google.login');


//Admin Interface
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');

    //Student Routes
    Route::controller(App\Http\Controllers\Admin\StudentsController::class)->group(function(){
        Route::get('students', 'index')->name('students.index');
        Route::get('students/create', 'create')->name('students.create');
        Route::post('students', 'storeStudent')->name('students.store');
        Route::get('students/{student}/edit', 'edit')->name('students.edit');
        Route::put('students/{student}', 'updateStudent')->name('students.update');
        Route::get('students/{student}/delete', 'deleteStudent')->name('students.delete');
    });

    //Add Tag UID for Students Routes
    Route::controller(App\Http\Controllers\Admin\StudentsController::class)->group(function(){
        Route::get('students/addtaguid', 'indextaguid')->name('students.addtaguid');
    });

    //Attendances Routes
    Route::controller(App\Http\Controllers\Admin\AttendancesController::class)->group(function(){
        Route::get('attendances/current', 'currentIndex')->name('attendances.current');
        Route::get('attendances', 'index')->name('attendances.index');
    });

    //RFID Checker
    Route::controller(App\Http\Controllers\Admin\RfidCheckerController::class)->group(function(){
        Route::get('rfidchecker', 'index')->name('rfidchecker.index');
    });

    //Settings Routes
    Route::controller(App\Http\Controllers\Admin\SettingsController::class)->group(function(){
        Route::get('settings', 'index')->name('settings.index');
        Route::post('settings', 'saveSettings')->name('settings.saveSettings');
        Route::patch('settings', 'updateAdminProfile')->name('settings.updateProfile');
    });

    //Sections Routes
    Route::controller(App\Http\Controllers\Admin\SectionsController::class)->group(function(){
        Route::get('sections', 'index')->name('sections.index');
    });

    //Events Routes
    Route::controller(App\Http\Controllers\Admin\EventsController::class)->group(function(){
        Route::get('events', 'index')->name('events.index');
    });

    //Subjects Routes
    Route::controller(App\Http\Controllers\Admin\SubjectsController::class)->group(function(){
        Route::get('subjects', 'index')->name('subjects.index');
    });

    //Instructors Routes
    Route::controller(App\Http\Controllers\Admin\InstructorsController::class)->group(function(){
        Route::get('instructors', 'index')->name('instructors.index');
    });

    //Add Tag UID for Instructor Routes
    Route::controller(App\Http\Controllers\Admin\InstructorsController::class)->group(function(){
        Route::get('instructors/addtaguid', 'indextaguid')->name('instructors.addtaguid');
    });

    //Schedules Routes
    Route::controller(App\Http\Controllers\Admin\SchedulesController::class)->group(function(){
        Route::get('schedules', 'index')->name('schedules.index');
        Route::get('schedules/makeupscheds', 'makeupIndex')->name('schedules.makeup');
        Route::get('schedules/makeupapprovals', 'approvalsIndex')->name('schedules.approvals');
    });

    //Logs
    Route::controller(App\Http\Controllers\Admin\LogsController::class)->group(function(){
        Route::get('logs', 'index')->name('logs.index');
    });
});

//Instructor Interface
Route::middleware('auth:instructor')->prefix('instructor')->name('instructor.')->group(function () {
    //Schedule Routes
    Route::controller(App\Http\Controllers\Instructor\SchedulesController::class)->group(function () {
        Route::get('schedules', 'index')->name('schedules.index');
        Route::get('makeupscheds', 'makeupIndex')->name('schedules.makeup');
    });

    //Events Routes
    Route::controller(App\Http\Controllers\Instructor\EventsController::class)->group(function () {
        Route::get('events', 'index')->name('events.index');
    });

    //Profile Routes
    Route::controller(App\Http\Controllers\Instructor\SettingsController::class)->group(function () {
        Route::get('settings', 'index')->name('settings.index');
        Route::patch('settings', 'updateProfile')->name('settings.updateProfile');
    });
});

require __DIR__.'/user-auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/instructor-auth.php';
