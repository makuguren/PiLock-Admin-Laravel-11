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

    Route::prefix('faculties')->group(function () {
        Route::get('/', App\Livewire\Archive\Admin\Faculties::class)->name('faculties.index');
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

// Faculty Interface
Route::middleware('guest:archive_faculty')->prefix('archive/faculty')->name('archive.faculty.')->group(function () {
    Route::get('login', [App\Http\Controllers\Archive\Faculty\Auth\AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [App\Http\Controllers\Archive\Faculty\Auth\AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:archive_faculty')->prefix('archive/faculty')->name('archive.faculty.')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Archive\Faculty\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Archive\Faculty\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Archive\Faculty\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('password', [App\Http\Controllers\Archive\Faculty\Auth\PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [App\Http\Controllers\Archive\Faculty\Auth\AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::middleware(['auth:archive_faculty', App\Http\Middleware\Archive\FacultyComponentLayout::class])->prefix('archive/faculty')->name('archive.faculty.')->group(function () {

    Route::get('dashboard', App\Livewire\Archive\Faculty\Dashboard::class)->name('dashboard.index');

    Route::prefix('attendances')->group(function () {
        Route::get('/', App\Livewire\Archive\Faculty\Attendances::class)->name('attendances.index');
    });

    Route::prefix('events')->group(function () {
        Route::get('/', App\Livewire\Archive\Faculty\Events::class)->name('events.index');
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', App\Livewire\Archive\Faculty\Courses::class)->name('courses.index');
        Route::get('blockedstudents', App\Livewire\Archive\Faculty\CoursesBlockedStudents::class)->name('courses.blocked');
    });

    Route::prefix('students')->group(function() {
        Route::get('/', App\Livewire\Archive\Faculty\Students::class)->name('students.index');
    });

    Route::prefix('schedules')->group(function () {
        Route::get('/', App\Livewire\Archive\Faculty\RegSchedules::class)->name('schedules.index');
        Route::get('makeupscheds', App\Livewire\Archive\Faculty\MakeupScheds::class)->name('schedules.makeup');
    });

    Route::prefix('seatplan')->group(function () {
        Route::get('/', App\Livewire\Archive\Faculty\SeatPlanIndex::class)->name('seatplan.index');
        Route::get('assign', App\Livewire\Archive\Faculty\SeatPlanEdit::class)->name('seatplan.assign');
    });

    Route::controller(App\Http\Controllers\Archive\Faculty\SettingsController::class)->group(function () {
        Route::get('settings', 'index')->name('settings.index');
        Route::patch('settings', 'updateProfile')->name('settings.updateProfile');
    });
});
