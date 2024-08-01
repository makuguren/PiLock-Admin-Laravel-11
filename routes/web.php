<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SocialLoginController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome.index');

// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('Autogen_V3_Livewire_3/public/livewire/update', $handle);
// });

// Livewire::setScriptRoute(function ($handle) {
//     return Route::get('Autogen_V3_Livewire_3/public/livewire/livewire.js', $handle);
// });

// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//User Interface
Route::middleware(['auth:web', App\Http\Middleware\UserComponentLayout::class])->name('user.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Dashboard Routes
    Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard.index');

    //Profile Routes
    Route::controller(App\Http\Controllers\User\SettingsController::class)->group(function () {
        Route::get('settings', 'index')->name('settings.index');
        Route::patch('settings', 'updateProfile')->name('settings.updateProfile');
    });
});

Route::get('/socialite/google', [SocialLoginController::class, 'toProvider'])->name('socialite.login');
Route::get('/auth/google/login', [SocialLoginController::class, 'handleCallback'])->name('auth.google.login');


//Admin Interface
Route::middleware(['auth:admin', App\Http\Middleware\AdminComponentLayout::class])->prefix('admin')->name('admin.')->group(function () {
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
Route::middleware(['auth:instructor', App\Http\Middleware\InstructorComponentLayout::class])->prefix('instructor')->name('instructor.')->group(function () {
    //Dashboard Routes
    Route::get('dashboard', [App\Http\Controllers\Instructor\DashboardController::class, 'index'])->name('dashboard.index');

    //Attendances Routes
    Route::controller(App\Http\Controllers\Instructor\AttendancesController::class)->group(function () {
        Route::get('attendances', 'index')->name('attendances.index');
    });

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

    // SeatPlan Routes
    Route::prefix('seatplan')->group(function () {
        Route::get('/', App\Livewire\Instructor\SeatPlan\Index::class)->name('seatplan.index');
        Route::get('assign', App\Livewire\Instructor\SeatPlan\EditSP::class)->name('seatplan.assign');
    });
});

require __DIR__.'/user-auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/instructor-auth.php';
