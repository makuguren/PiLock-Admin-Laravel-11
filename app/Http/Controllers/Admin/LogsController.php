<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\ScheduleNow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogsController extends Controller
{
    public function index(){
        return view('admin.logs.index');
    }

    public function attendStudentAPI(String $student_id){
        $students = User::where('student_id', $student_id)->get();
        $schedule_now = ScheduleNow::first();
        $datetime = Carbon::now('Asia/Manila');
        if($students->count() > 0){
            if ($schedule_now != NULL) {
                foreach ($students as $student) {
                    $students = Log::create([
                        'student_id' => $student->id,
                        'section_id' => $student->section_id,
                        'subject_id' => $schedule_now->subject_id,
                        'instructor_id' => $schedule_now->instructor_id,
                        'date' => $datetime->toDateString(),
                        'time' => $datetime->toTimeString()
                    ]);
                }
                return response()->json([
                    'status' => 200,
                    'status_message' => 'Saved Logs Successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'status_message' => 'Saved Logs Unsuccessfully'
                ], 404);
            }

        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Student Found'
            ], 404);
        }
    }
}
