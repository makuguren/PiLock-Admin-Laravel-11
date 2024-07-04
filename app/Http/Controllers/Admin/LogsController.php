<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Schedules;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogsController extends Controller
{
    public function index(){
        return view('admin.logs.index');
    }

    public function attendStudentAPI(String $student_id){
        $student = User::where('student_id', $student_id)->first();
        $schedule_now = Schedules::where('isCurrent', '1')->first();
        $datetime = Carbon::now('Asia/Manila');

        // Check if student exists
        if (!$student) {
            return response()->json([
                'status' => 404,
                'status_message' => 'Student not found'
            ], 404);
        } elseif($schedule_now != NULL) {
            //Update isPresent Query in Attendance
            $isPresent = Attendance::where('student_id', $student->id);

            //Checking if the Student Matched by their Schedule
            if($student->section_id == $schedule_now->section_id){
                //Save Logs by Tapping their RFID
                $student = Log::create([
                    'student_id' => $student->id,
                    'section_id' => $student->section_id,
                    'subject_id' => $schedule_now->subject_id,
                    'instructor_id' => $schedule_now->instructor_id,
                    'date' => $datetime->toDateString(),
                    'time' => $datetime->toTimeString()
                ]);

                //Update isPresent set 1 for Present
                $isPresent->update([
                    'isPresent' => '1'
                ]);

                return response()->json([
                    'status' => 200,
                    'status_message' => 'Saved Logs Successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 200,
                    'status_message' => 'You are not Allowed to Enter your Class!'
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Schedules Found'
            ], 404);
        }
    }
}
