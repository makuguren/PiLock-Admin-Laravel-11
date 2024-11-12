<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Course;
use App\Models\Schedules;
use App\Models\Attendance;
use App\Models\FacultyLog;
use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Models\EnrolledCourse;
use App\Models\MakeupSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class LogsController extends Controller
{

    public function attendStudentAPI(String $tag_uid){
        $student = User::where('tag_uid', $tag_uid)->first();
        $schedule_now = Schedules::where('isCurrent', '1')->first();
        $makeupSched_now = MakeupSchedule::where('isCurrent', '1')->first();
        $datetime = Carbon::now('Asia/Manila');

        // Check if the student exists
        if (!$student) {
            return response()->json([
                'status' => 404,
                'status_message' => 'Student not found'
            ], 404);
        }

        // Check if there is a current schedule (Regular Classes)
        if ($schedule_now) {
            // Find the enrolled course based on the schedule and student
            $enrolledCourse = EnrolledCourse::where('course_id', $schedule_now->course_id)
            ->where('student_id', $student->id)
            ->first();

            // If enrolledCourse is not found, the student is not enrolled in the course for the current schedule
            if (!$enrolledCourse) {
                return response()->json([
                    'status' => 403,
                    'status_message' => 'You are not allowed to enter your class!'
                ], 404);
            }

            // Proceed if the Faculty has already tapped their ID
            if ($schedule_now->isAttend == '1') {

                // Save logs for the student
                Log::create([
                    'student_id' => $student->id,
                    'course_id' => $enrolledCourse->course_id,
                    'date' => $datetime->toDateString(),
                    'time_in' => $datetime->toTimeString()
                ]);


                // Mark the student as present
                $updateStud = Attendance::where('student_id', $student->id)->first();

                $updateStud->update([
                    'isPresent' => '1'
                ]);

                // Update the Time Attend as well
                if($updateStud->time_attend == NULL){
                    $updateStud->update([
                        'time_attend' => $datetime->toTimeString()
                    ]);
                }

                return response()->json([
                    'status' => 200,
                    'status_message' => 'Saved Logs Successfully'
                ], 200);

            } else {
                return response()->json([
                    'status' => 401,
                    'status_message' => 'Faculty has not tapped the ID'
                ], 401);
            }
        } elseif ($makeupSched_now) {
            // Find the enrolled course based on the schedule and student
            $enrolledCourse = EnrolledCourse::where('course_id', $makeupSched_now->course_id)
                    ->where('student_id', $student->id)
                    ->first();

            // If enrolledCourse is not found, the student is not enrolled in the course for the current schedule
            if (!$enrolledCourse) {
                return response()->json([
                    'status' => 403,
                    'status_message' => 'You are not allowed to enter your class!'
                ], 404);
            }

            // Proceed if the Faculty has already tapped their ID
            if ($makeupSched_now->isAttend == '1') {

                // Save logs for the student
                Log::create([
                    'student_id' => $student->id,
                    'course_id' => $enrolledCourse->course_id,
                    'date' => $datetime->toDateString(),
                    'time_in' => $datetime->toTimeString()
                ]);


                // Mark the student as present
                Attendance::where('student_id', $student->id)->update([
                    'isPresent' => '1'
                ]);

                return response()->json([
                    'status' => 200,
                    'status_message' => 'Saved Logs Successfully'
                ], 200);

            } else {
                return response()->json([
                    'status' => 401,
                    'status_message' => 'Faculty has not tapped the ID'
                ], 401);
            }
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Schedules Found'
            ], 404);
        }
    }

    public function exitStudFacAPI(int $tag_uid){
        $datetime = Carbon::now('Asia/Manila');
        $studentId = User::where('tag_uid', $tag_uid)->pluck('id');
        $studentLog = Log::where('student_id', $studentId)->whereNull('time_out');

        try {
            // Faculty Time Out
            $facultyId = Faculty::where('tag_uid', $tag_uid)->pluck('id')->first();

            if($facultyId){
                $getCourseId = Course::where('faculty_id', $facultyId)->pluck('id')->toArray();

                $facultyLog = FacultyLog::whereIn('course_id', $getCourseId)
                    ->whereNull('time_out');

                if($facultyLog){
                    $facultyLog->update([
                        'time_out' => $datetime->toTimeString()
                    ]);

                    return response()->json([
                        'status' => 200,
                        'message' => 'Faculty Time Out Logs Successfully!'
                    ], 200);
                }

            // Student Time Out
            } else if ($studentLog){
                $studentLog->update([
                    'time_out' => $datetime->toTimeString()
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Student Time Out Logs Successfully!'
                ], 200);
            }
        } catch (QueryException) {
            return response()->json([
                'status' => 404,
                'message' => 'No Student or Faculty Found!'
            ], 404);
        }
    }

    public function attendFacultyAPI(int $tag_uid){
        $faculty = Faculty::where('tag_uid', $tag_uid)->first();
        $schedule_now = Schedules::where('isCurrent', '1')->first();
        $datetime = Carbon::now('Asia/Manila');

        if($schedule_now){
            if($faculty){
                $schedule_now->update([
                    'isAttend' => '1'
                ]);

                // Saving Details to Faculty Logs
                FacultyLog::create([
                    'course_id' => $schedule_now->course->id,
                    'time_in' => $datetime->toTimeString(),
                    'date' => $datetime->toDateString(),
                ]);

                return response()->json([
                    'status' => 200,
                    'status_message' => 'Faculty Tapped ID Successfully!'
                ], 200);

            } else {
                return response()->json([
                    'status' => 404,
                    'status_message' => 'No Faculty Found'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Schedule Found'
            ], 404);
        }
    }
}
