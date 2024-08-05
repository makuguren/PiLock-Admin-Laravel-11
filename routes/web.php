<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SocialLoginController;

Route::get('/', function () {
    return view('landing');
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

    // Dashboard Routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', App\Livewire\Admin\Dashboard\Index::class)->name('dashboard.index')
            ->middleware('permission:View Dashboard');
    });

    //Student Routes
    Route::prefix('students')->group(function () {
        Route::get('/', App\Livewire\Admin\Students\Index::class)->name('students.index')
            ->middleware('permission:View Students');
    });

    Route::controller(App\Http\Controllers\Admin\StudentsController::class)->group(function(){
        Route::get('students/create', 'create')->name('students.create');
        Route::post('students', 'storeStudent')->name('students.store');
        Route::get('students/{student}/edit', 'edit')->name('students.edit');
        Route::put('students/{student}', 'updateStudent')->name('students.update');
    });

    //Add Tag UID for Students Routes
    Route::prefix('students')->group(function () {
        Route::get('addtaguid', App\Livewire\Admin\Students\Adduid::class)->name('students.addtaguid')
            ->middleware('permission:Add Tag UID to Students');
    });

    //Attendances Routes
    // Route::prefix('attendances')->group(function () {
    //     Route::get('/', App\Livewire\Admin\Attendances\Index::class)->name('attendances.index')
    //         ->middleware('permission:View Attendances');
    //     Route::get('current', App\Livewire\Admin\Attendances\Current::class)->name('attendances.current')
    //         ->middleware('permission:View Current Attendances');
    // });

    //RFID Checker
    Route::prefix('rfidchecker')->group(function () {
        Route::get('/', App\Livewire\Admin\RfidChecker\Index::class)->name('rfidchecker.index')
            ->middleware('permission:View RFID Checker');
    });

    //Sections Routes
    Route::prefix('sections')->group(function () {
        Route::get('/', App\Livewire\Admin\Sections\Index::class)->name('sections.index')
            ->middleware('permission:View Sections');
    });

    //Events Routes
    Route::prefix('events')->group(function () {
        Route::get('/', App\Livewire\Admin\Events\Index::class)->name('events.index')
            ->middleware('permission:View Events');
    });

    //Subjects Routes
    Route::prefix('subjects')->group(function () {
        Route::get('/', App\Livewire\Admin\Subjects\Index::class)->name('subjects.index')
            ->middleware('permission:View Subjects');
    });

    //Instructors Routes with Tag UID
    Route::prefix('instructors')->group(function () {
        Route::get('/', App\Livewire\Admin\Instructors\Index::class)->name('instructors.index')
            ->middleware('permission:View Instructors');
        Route::get('addtaguid', App\Livewire\Admin\Instructors\Adduid::class)->name('instructors.addtaguid')
            ->middleware('permission:Add Tag UID to Instructors');
    });

    //Schedules Routes
    Route::prefix('schedules')->group(function () {
        Route::get('/', App\Livewire\Admin\Schedules\Index::class)->name('schedules.index')
            ->middleware('permission:View Regular Schedules');
        Route::get('makeupscheds', App\Livewire\Admin\Schedules\Makeup::class)->name('schedules.makeup')
            ->middleware('permission:View Make-Up Schedules');
        Route::get('makeupapprovals', App\Livewire\Admin\Schedules\Approvals::class)->name('schedules.approvals')
            ->middleware('permission:View Make-Up SchedApprovals');
    });

    //Logs
    Route::prefix('logs')->group(function () {
        Route::get('/', App\Livewire\Admin\Logs\Index::class)->name('logs.index')
            ->middleware('permission:View Logs');
    });

    //Permissions Routes
    Route::prefix('permissions')->group(function () {
        Route::get('/', App\Livewire\Admin\Permissions\Index::class)->name('permissions.index')
            ->middleware('permission:View Permissions');
    });

    //Roles Routes
    Route::prefix('roles')->group(function () {
        Route::get('/', App\Livewire\Admin\Roles\Index::class)->name('roles.index')
            ->middleware('permission:View Roles');
    });

    Route::controller(App\Http\Controllers\Admin\RolesController::class)->group(function(){
        Route::get('roles/{role_id}/give-permissions', 'addPermissionToRole')->name('roles.addpermission');
        Route::put('roles/{role_id}', 'givePermissionToRole')->name('roles.givepermission');
    });

    // Admins Routes
    Route::prefix('admins')->group(function () {
        Route::get('/', App\Livewire\Admin\Admins\Index::class)->name('admins.index');
    });

    Route::controller(App\Http\Controllers\Admin\AdminsController::class)->group(function(){
        Route::get('admins/create', 'create')->name('admins.create');
        Route::post('admins/create', 'store')->name('admins.store');
        Route::get('admins/{admin}/edit', 'edit')->name('admins.edit');
        Route::put('admins/{admin}', 'update')->name('admins.update');
    });

    //Settings Routes
    Route::controller(App\Http\Controllers\Admin\SettingsController::class)->group(function(){
        Route::get('settings', 'index')->name('settings.index');
        Route::post('settings', 'saveSettings')->name('settings.saveSettings');
        Route::patch('settings', 'updateAdminProfile')->name('settings.updateProfile');
    });

    // Route::resource('admins', App\Http\Controllers\Admin\AdminsController::class);
    // Route::get('admins/{adminId}/delete', [App\Http\Controllers\Admin\AdminsController::class, 'destroy'])->name('admins.delete');
});

//Instructor Interface
Route::middleware(['auth:instructor', App\Http\Middleware\InstructorComponentLayout::class])->prefix('instructor')->name('instructor.')->group(function () {

    //Dashboard Routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', App\Livewire\Instructor\Dashboard\Index::class)->name('dashboard.index');
    });

    //Attendances Routes
    Route::prefix('attendances')->group(function () {
        Route::get('/', App\Livewire\Instructor\Attendances\Index::class)->name('attendances.index');
        Route::get('/', App\Livewire\Instructor\Attendances\Index::class)->name('attendances.current');
    });

    //Schedule Routes
    Route::prefix('schedules')->group(function () {
        Route::get('/', App\Livewire\Instructor\Schedules\Index::class)->name('schedules.index');
        Route::get('makeupscheds', App\Livewire\Instructor\Schedules\Makeup::class)->name('schedules.makeup');
    });

    //Events Routes
    Route::prefix('events')->group(function () {
        Route::get('/', App\Livewire\Instructor\Events\Index::class)->name('events.index');
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
