<?php
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Archive\Admin\ProfileController;
use App\Http\Controllers\Archive\Admin\Auth\PasswordController;

// Admin Interface
Route::middleware('guest:archive_admin')->prefix('archive/admin')->name('archive.admin.')->group(function () {
    Route::get('login', [App\Http\Controllers\Archive\Admin\Auth\AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [App\Http\Controllers\Archive\Admin\Auth\AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:archive_admin')->prefix('archive/admin')->name('archive.admin.')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Archive\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Archive\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Archive\Admin\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [App\Http\Controllers\Archive\Admin\Auth\AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::middleware(['auth:archive_admin', App\Http\Middleware\Archive\AdminComponentLayout::class])->prefix('archive/admin')->name('archive.admin.')->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\Dashboard::class)->name('dashboard.index');
    });

    Route::prefix('rfidchecker')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\RfidChecker::class)->name('rfidchecker.index');
    });

    Route::prefix('sections')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\Sections::class)->name('sections.index');
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\Courses::class)->name('courses.index');
    });

    Route::prefix('students')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\Students::class)->name('students.index');
    });

    Route::prefix('instructors')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\Faculties::class)->name('instructors.index');
    });

    Route::prefix('events')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\Events::class)->name('events.index');
    });

    Route::prefix('schedules')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\RegSchedules::class)->name('schedules.index');
        Route::get('timetable', App\Livewire\Archive\Admin\Timetable::class)->name('schedules.timetable');
        Route::get('makeupscheds', App\Livewire\Archive\Admin\MakeupScheds::class)->name('schedules.makeup');
        Route::get('makeupapprovals', App\Livewire\Archive\Admin\MakeupApprovals::class)->name('schedules.approvals');
    });

    Route::prefix('admins')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\Admins::class)->name('admins.index');
    });

    Route::prefix('logs')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\Logs::class)->name('logs.index');
    });

    Route::controller(App\Http\Controllers\Archive\Admin\SettingsController::class)->group(function(){
        Route::get('settings', 'index')->name('settings.index');
        Route::post('settings', 'saveSettings')->name('settings.saveSettings');
        Route::patch('settings', 'updateAdminProfile')->name('settings.updateProfile');
    });
});

// Instructor Interface
Route::middleware('guest:archive_instructor')->prefix('archive/instructor')->name('archive.instructor.')->group(function () {
    Route::get('login', [App\Http\Controllers\Archive\Instructor\Auth\AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [App\Http\Controllers\Archive\Instructor\Auth\AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:archive_instructor')->prefix('archive/instructor')->name('archive.instructor.')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Archive\Instructor\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Archive\Instructor\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Archive\Instructor\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('password', [App\Http\Controllers\Archive\Instructor\Auth\PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [App\Http\Controllers\Archive\Instructor\Auth\AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::middleware(['auth:archive_instructor', App\Http\Middleware\Archive\InstructorComponentLayout::class])->prefix('archive/instructor')->name('archive.instructor.')->group(function () {

    Route::get('dashboard', App\Livewire\Archive\Instructor\Dashboard::class)->name('dashboard.index');

    Route::prefix('attendances')->group(function () {
        Route::get('/', App\Livewire\Archive\Instructor\Attendances::class)->name('attendances.index');
    });

    Route::prefix('events')->group(function () {
        Route::get('/', App\Livewire\Archive\Instructor\Events::class)->name('events.index');
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', App\Livewire\Archive\Instructor\Courses::class)->name('courses.index');
        Route::get('blockedstudents', App\Livewire\Archive\Instructor\CoursesBlockedStudents::class)->name('courses.blocked');
    });

    Route::prefix('students')->group(function() {
        Route::get('/', App\Livewire\Archive\Instructor\Students::class)->name('students.index');
    });

    Route::prefix('schedules')->group(function () {
        Route::get('/', App\Livewire\Archive\Instructor\RegSchedules::class)->name('schedules.index');
        Route::get('makeupscheds', App\Livewire\Archive\Instructor\MakeupScheds::class)->name('schedules.makeup');
    });

    Route::prefix('seatplan')->group(function () {
        Route::get('/', App\Livewire\Archive\Instructor\SeatPlanIndex::class)->name('seatplan.index');
        Route::get('assign', App\Livewire\Archive\Instructor\SeatPlanEdit::class)->name('seatplan.assign');
    });

    Route::controller(App\Http\Controllers\Archive\Instructor\SettingsController::class)->group(function () {
        Route::get('settings', 'index')->name('settings.index');
        Route::patch('settings', 'updateProfile')->name('settings.updateProfile');
    });
});
