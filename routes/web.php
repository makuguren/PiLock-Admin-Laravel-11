<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckStudentInfo;
use App\Http\Controllers\User\ProfileController;
use App\Http\Middleware\CheckFacultyDefaultPass;

Route::get('/', function () {
    return view('landing');
})->name('welcome.index');

// Route::get('/pastebin', function () {
//     $array = json_decode(\Http::get('https://pastebin.com/raw/UKhcdjRe'), true);
//     $allowd_ips = $array['configurations']['maintenance']['allowed_ips'] ?? [];

//     return ($allowd_ips);
// });

// Route::get('/ipconfig', function () {
//     $blocked_ips = ['192.168.8.156', '203.0.113.5']; // Example blocked IPs
//     $client_ip = $_SERVER['REMOTE_ADDR'];

//     if (in_array($client_ip, $blocked_ips)) {
//         // Deny access
//         header('HTTP/1.0 403 Forbidden');
//         echo "Access denied.";
//         exit;
//     }

// });

// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('Autogen_V3_Livewire_3/public/livewire/update', $handle);
// });

// Livewire::setScriptRoute(function ($handle) {
//     return Route::get('Autogen_V3_Livewire_3/public/livewire/livewire.js', $handle);
// });

// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//User Interface || Dashboard Routes
Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard.index');

Route::middleware(['auth:web', App\Http\Middleware\UserComponentLayout::class, CheckStudentInfo::class])->name('user.')->group(function () {
    // Schedules Routes
    Route::prefix('schedules')->group(function () {
        Route::get('/', App\Livewire\User\Schedules\Index::class)->name('schedules.index');
    });

    //Courses Routes
    Route::prefix('courses')->group(function () {
        Route::get('/', App\Livewire\User\Courses\Index::class)->name('courses.index');
        Route::get('enrolledcourses', App\Livewire\User\Courses\Enrolled::class)->name('courses.enrolled');
    });

    //Profile Routes
    Route::controller(App\Http\Controllers\User\SettingsController::class)->group(function () {
        Route::get('settings', 'index')->name('settings.index');
        Route::patch('settings', 'updateProfile')->name('settings.updateProfile');
    });

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Socialite Routes for User Authentication
Route::get('/socialite/google', [App\Http\Controllers\User\SocialLoginController::class, 'toProvider'])->name('socialite.login');
Route::get('/auth/google/login', [App\Http\Controllers\User\SocialLoginController::class, 'handleCallback'])->name('auth.google.login');

// Socialite Routes for Faculty Authentication
Route::get('/socialite/google/instructor', [App\Http\Controllers\Faculty\SocialLoginController::class, 'toProvider'])->name('socialite.instructor.login');
Route::get('/auth/google/instructor/login', [App\Http\Controllers\Faculty\SocialLoginController::class, 'handleCallback'])->name('auth.instructor.google.login');

//Admin Interface
Route::middleware(['auth:admin', App\Http\Middleware\AdminComponentLayout::class])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', App\Livewire\Admin\Dashboard\Index::class)->name('dashboard.index')
            ->middleware('permission:View Dashboard');
    });

    //RFID Checker
    Route::prefix('rfidchecker')->group(function () {
        Route::get('/', App\Livewire\Admin\RfidChecker\Index::class)->name('rfidchecker.index')
            ->middleware('permission:View RFID Checker');
    });

    // Analytics Routes
    // Route::prefix('analytics')->group(function () {
    //     Route::get('/', App\Livewire\Admin\Analytics\Index::class)->name('analytics.index')
    //         ->middleware('permission:View Analytics');
    // });

    //Sections Routes
    Route::prefix('sections')->group(function () {
        Route::get('/', App\Livewire\Admin\Sections\Index::class)->name('sections.index')
            ->middleware('permission:View Sections');
    });

    //Courses Routes
    Route::prefix('courses')->group(function () {
        Route::get('/', App\Livewire\Admin\Courses\Index::class)->name('courses.index')
            ->middleware('permission:View Courses');
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

    //Faculties Routes with Tag UID
    Route::prefix('faculties')->group(function () {
        Route::get('/', App\Livewire\Admin\Faculties\Index::class)->name('faculties.index')
            ->middleware('permission:View Instructors');
        Route::get('addtaguid', App\Livewire\Admin\Faculties\Adduid::class)->name('faculties.addtaguid')
            ->middleware('permission:Add Tag UID to Instructors');
    });

    //Events Routes
    Route::prefix('events')->group(function () {
        Route::get('/', App\Livewire\Admin\Events\Index::class)->name('events.index')
            ->middleware('permission:View Events');
    });

    //Schedules Routes
    Route::prefix('schedules')->group(function () {
        Route::get('/', App\Livewire\Admin\Schedules\Index::class)->name('schedules.index')
            ->middleware('permission:View Regular Schedules');
        Route::get('timetable', App\Livewire\Admin\Schedules\Timetable::class)->name('schedules.timetable');
        Route::get('makeupscheds', App\Livewire\Admin\MakeupSched\Index::class)->name('schedules.makeup');
            // ->middleware('permission:View Make-Up Schedules');
        Route::get('makeupapprovals', App\Livewire\Admin\MakeupSched\Approvals::class)->name('schedules.approvals');
            // ->middleware('permission:View Make-Up SchedApprovals');
    });

    // Route::prefix('schedules')->group(function () {
    //     Route::get('/', App\Livewire\Admin\Schedules\Index::class)->name('schedules.index')
    //         ->middleware('permission:View Regular Schedules');
    //     Route::get('timetable', App\Livewire\Admin\Schedules\Timetable::class)->name('schedules.timetable');
    //     Route::get('makeupscheds', App\Livewire\Admin\Schedules\Makeup::class)->name('schedules.makeup')
    //         ->middleware('permission:View Make-Up Schedules');
    //     Route::get('makeupapprovals', App\Livewire\Admin\Schedules\Approvals::class)->name('schedules.approvals')
    //         ->middleware('permission:View Make-Up SchedApprovals');
    // });

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

    //Roles Routes
    Route::prefix('roles')->group(function () {
        Route::get('/', App\Livewire\Admin\Roles\Index::class)->name('roles.index')
            ->middleware('permission:View Roles');
    });

    Route::controller(App\Http\Controllers\Admin\RolesController::class)->group(function(){
        Route::get('roles/{role_id}/give-permissions', 'addPermissionToRole')->name('roles.addpermission');
        Route::put('roles/{role_id}', 'givePermissionToRole')->name('roles.givepermission');
    });

    //Permissions Routes
    Route::prefix('permissions')->group(function () {
        Route::get('/', App\Livewire\Admin\Permissions\Index::class)->name('permissions.index')
            ->middleware('permission:View Permissions');
    });

    //Logs Routes
    Route::prefix('logs')->group(function () {
        Route::get('/', App\Livewire\Admin\Logs\Index::class)->name('logs.index')
            ->middleware('permission:View Logs');
    });

    //Settings Routes
    Route::controller(App\Http\Controllers\Admin\SettingsController::class)->group(function(){
        Route::get('settings', 'index')->name('settings.index');
        Route::post('settings', 'saveSettings')->name('settings.saveSettings');
        Route::patch('settings', 'updateAdminProfile')->name('settings.updateProfile');
    });

    //Archives Routes
    Route::prefix('archives')->group(function () {
        Route::get('/', App\Livewire\Admin\Archives\Index::class)->name('archives.index');
    });

    // Seat Configuration Routes
    Route::prefix('seatsconfig')->group(function () {
        Route::get('/', App\Livewire\Admin\SeatsConfiguration\Index::class)->name('seatsconfig.index');
    });


    //Attendances Routes
    // Route::prefix('attendances')->group(function () {
    //     Route::get('/', App\Livewire\Admin\Attendances\Index::class)->name('attendances.index')
    //         ->middleware('permission:View Attendances');
    //     Route::get('current', App\Livewire\Admin\Attendances\Current::class)->name('attendances.current')
    //         ->middleware('permission:View Current Attendances');
    // });

    // Route::controller(App\Http\Controllers\Admin\SchedulesController::class)->group(function(){
    //     Route::post('schedules/import', 'importSchedule')->name('schedules.import');
    // });

    // Route::resource('admins', App\Http\Controllers\Admin\AdminsController::class);
    // Route::get('admins/{adminId}/delete', [App\Http\Controllers\Admin\AdminsController::class, 'destroy'])->name('admins.delete');
});

//Faculty Interface || Dashboard Routes
Route::middleware(['auth:faculty', App\Http\Middleware\FacultyComponentLayout::class])->prefix('faculty/dashboard')->group(function () {
    Route::get('/', App\Livewire\Faculty\Dashboard\Index::class)->name('faculty.dashboard.index');
});

Route::middleware(['auth:faculty', App\Http\Middleware\FacultyComponentLayout::class, CheckFacultyDefaultPass::class])->prefix('faculty')->name('faculty.')->group(function () {

    //Attendances Routes
    Route::prefix('attendances')->group(function () {
        Route::get('/', App\Livewire\Faculty\Attendances\Index::class)->name('attendances.index');
        Route::get('current', App\Livewire\Faculty\Attendances\Current::class)->name('attendances.current');
    });

    //Events Routes
    Route::prefix('events')->group(function () {
        Route::get('/', App\Livewire\Faculty\Events\Index::class)->name('events.index');
    });

    //Courses Routes
    Route::prefix('courses')->group(function () {
        Route::get('/', App\Livewire\Faculty\Courses\Index::class)->name('courses.index');
        Route::get('blockedstudents', App\Livewire\Faculty\Courses\BlockedStudents::class)->name('courses.blocked');
    });

    //Students Routes
    Route::prefix('students')->group(function() {
        Route::get('/', App\Livewire\Faculty\Students\Index::class)->name('students.index');
    });

    //Schedule Routes
    Route::prefix('schedules')->group(function () {
        Route::get('/', App\Livewire\Faculty\Schedules\Index::class)->name('schedules.index');
        Route::get('makeupscheds', App\Livewire\Faculty\Schedules\Makeup::class)->name('schedules.makeup');
    });

    // SeatPlan Routes
    Route::prefix('seatplan')->group(function () {
        Route::get('/', App\Livewire\Faculty\SeatPlan\Index::class)->name('seatplan.index');
        Route::get('assign', App\Livewire\Faculty\SeatPlan\EditSP::class)->name('seatplan.assign');
    });

    //Profile Routes
    Route::controller(App\Http\Controllers\Faculty\SettingsController::class)->group(function () {
        Route::get('settings', 'index')->name('settings.index');
        Route::patch('settings', 'updateProfile')->name('settings.updateProfile');
    });
});

require __DIR__.'/user-auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/faculty-auth.php';
require __DIR__.'/archive.php';
