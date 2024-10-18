<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Course;
use App\Models\Schedules;
use App\Models\Attendance;
use App\Models\FacultyLog;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Models\EnrolledCourse;
use App\Models\MakeupSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class LogsController extends Controller
{
    // public function attendStudentAPI(String $tag_uid){
    //     $student = User::where('tag_uid', $tag_uid)->first();
    //     $instructor = Instructor::where('tag_uid', $tag_uid)->first();
    //     $schedule_now = Schedules::where('isCurrent', '1')->first();
    //     $datetime = Carbon::now('Asia/Manila');

    //     // This syntax is find the student via enrolledCourse
    //     $enrolledCourse = EnrolledCourse::where('course_id', $schedule_now->course_id)->where('student_id', $student->id)->first();
    //     info($enrolledCourse->course_id);

    //     //If the Instructor is Tapped their IDs then, Proceed to Students

    //     // Check if student exists
    //     if (!$student) {
    //         return response()->json([
    //             'status' => 404,
    //             'status_message' => 'Student not found'
    //         ], 404);
    //     } elseif($schedule_now != NULL) {
    //         //Update isPresent Query in Attendance
    //         $isPresent = Attendance::where('student_id', $student->id);

    //         //Check if the Instructor is Attended
    //         if($schedule_now->isAttend == '1'){

    //             //Checking if the Student Matched by their Schedule
    //             if($student->section_id == $schedule_now->course_id){



    //                 //Save Logs by Tapping their RFID
    //                 $student = Log::create([
    //                     'student_id' => $student->id,
    //                     'section_id' => $student->section_id,
    //                     'subject_id' => $schedule_now->subject_id,
    //                     'instructor_id' => $schedule_now->instructor_id,
    //                     'date' => $datetime->toDateString(),
    //                     'time' => $datetime->toTimeString()
    //                 ]);

    //                 //Update isPresent set 1 for Present
    //                 $isPresent->update([
    //                     'isPresent' => '1'
    //                 ]);

    //                 return response()->json([
    //                     'status' => 200,
    //                     'status_message' => 'Saved Logs Successfully'
    //                 ], 200);

    //             } else {
    //                 return response()->json([
    //                     'status' => 404,
    //                     'status_message' => 'You are not Allowed to Enter your Class!'
    //                 ], 404);
    //             }

    //         } else {
    //             return response()->json([
    //                 'status' => 401,
    //                 'status_message' => 'Instructor is not Tapped the ID'
    //             ], 401);
    //         }
    //     } else {
    //         return response()->json([
    //             'status' => 404,
    //             'status_message' => 'No Schedules Found'
    //         ], 404);
    //     }
    // }


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

            // Proceed if the instructor has already tapped their ID
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
                    'status_message' => 'Instructor has not tapped the ID'
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

            // Proceed if the instructor has already tapped their ID
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
                    'status_message' => 'Instructor has not tapped the ID'
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
            // Instructor Time Out
            $instructorId = Instructor::where('tag_uid', $tag_uid)->pluck('id')->first();

            if($instructorId){
                $getCourseId = Course::where('instructor_id', $instructorId)->pluck('id')->toArray();

                $facultyLog = FacultyLog::whereIn('course_id', $getCourseId)
                    ->whereNull('time_out');

                if($facultyLog){
                    $facultyLog->update([
                        'time_out' => $datetime->toTimeString()
                    ]);

                    return response()->json([
                        'status' => 200,
                        'message' => 'Instructor Time Out Logs Successfully!'
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

    public function attendInstructorAPI(int $tag_uid){
        $instructor = Instructor::where('tag_uid', $tag_uid)->first();
        $schedule_now = Schedules::where('isCurrent', '1')->first();
        $datetime = Carbon::now('Asia/Manila');

        if($schedule_now){
            if($instructor){
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
                    'status_message' => 'Instructor Tapped ID Successfully!'
                ], 200);

            } else {
                return response()->json([
                    'status' => 404,
                    'status_message' => 'No Instructor Found'
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
