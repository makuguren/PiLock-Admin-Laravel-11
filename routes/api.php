<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\FacultiesController;
use App\Http\Controllers\Admin\SchedulesController;
use App\Http\Controllers\Admin\Auth\APIAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [APIAuthController::class, 'login']);
Route::post('register', [APIAuthController::class, 'register']);

// API using laravel Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Students List
    Route::get('students/', [StudentsController::class, 'showStudentsAPI']);
    Route::get('student/{student_id}', [StudentsController::class, 'showStudentAPI']);

    //Faculties List
    Route::get('faculties/', [FacultiesController::class, 'showFacultiesAPI']);
    Route::get('faculty/{faculty_uid}', [FacultiesController::class, 'showFacultyAPI']);

    //Schedules List
    Route::get('schedules/', [SchedulesController::class, 'showSchedulesAPI']);
    Route::get('schedule/{schedule_id}', [SchedulesController::class, 'showScheduleAPI']);
    Route::get('makeupscheds/', [SchedulesController::class, 'showMakeUpSchedsAPI']);

    //Show Current Schedules
    Route::get('schedules/current', [SchedulesController::class, 'showCurrentSchedAPI']);

    //Inputting Faculties First and Students to Logs
    Route::post('attendstud/{tag_uid}', [LogsController::class, 'attendStudentAPI']);
    Route::post('attendfaculty/{tag_uid}', [LogsController::class, 'attendFacultyAPI']);

    Route::post('exitStudFac/{tag_uid}', [LogsController::class, 'exitStudFacAPI']);

    //Show All Events
    Route::get('events/', [EventsController::class, 'showEventsAPI']);

    // Show All Courses
    Route::get('courses/', [CoursesController::class, 'showCoursesAPI']);
    Route::get('enrolledcourses/', [CoursesController::class, 'showEnrolledCoursesAPI']);

    Route::post('logout', [APIAuthController::class, 'logout']);
});
