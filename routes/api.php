<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\SchedulesController;
use App\Http\Controllers\Admin\InstructorsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Students List
Route::get('students/', [StudentsController::class, 'showStudentsAPI']);
Route::get('student/{student_id}', [StudentsController::class, 'showStudentAPI']);

//Instructors List
Route::get('instructors/', [InstructorsController::class, 'showInstructorsAPI']);
Route::get('instructor/{instructor_uid}', [InstructorsController::class, 'showInstructorAPI']);

//Schedules List
Route::get('schedules/', [SchedulesController::class, 'showSchedulesAPI']);
Route::get('schedule/{schedule_id}', [SchedulesController::class, 'showScheduleAPI']);

//Show Current Schedules
Route::get('schedules/current', [SchedulesController::class, 'showCurrentSchedAPI']);

//Inputting Students to Logs
Route::post('attend/{student_id}', [LogsController::class, 'attendStudentAPI']);
