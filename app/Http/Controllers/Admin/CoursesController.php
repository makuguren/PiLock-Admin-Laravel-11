<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\EnrolledCourse;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    public function showCoursesAPI(){
        $courses = Course::all();
        if($courses->count() > 0){
            return response()->json([
                'courses' => $courses->map(function ($course) {
                    return [
                        'id' => $course->id,
                        'course_code' => $course->course_code,
                        'course_title' => $course->course_title,
                        'section' => $course->section->program . ' ' . $course->section->year . $course->section->block,
                        'instructor' => $course->instructor->name
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Courses Found'
            ], 404);
        }
    }

    public function showEnrolledCoursesAPI(){
        $enrolledCourses = EnrolledCourse::all();
        if($enrolledCourses->count() > 0){
            return response()->json([
                'enrolledCourses' => $enrolledCourses->map(function ($enrolledCourse) {
                    return [
                        'id' => $enrolledCourse->id,
                        'course_id' => $enrolledCourse->course_id,
                        'course_code' => $enrolledCourse->course->course_code,
                        'course_title' => $enrolledCourse->course->course_title,
                        'course_section' => $enrolledCourse->course->section->program . ' ' . $enrolledCourse->course->section->year . $enrolledCourse->course->section->block ?? null,
                        'course_instructor' => $enrolledCourse->course->instructor->name,
                        'student_id' => $enrolledCourse->student_id,
                        'studentTag_uid' => $enrolledCourse->tag_uid,
                        'student_number' => $enrolledCourse->student->student_id,
                        'student_name' => $enrolledCourse->student->name,
                        'student_section' => $enrolledCourse->student->section->program . ' ' . $enrolledCourse->student->section->year . $enrolledCourse->student->section->block ?? null,
                        'student_email' => $enrolledCourse->student->email,
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No EnrolledCourse Found'
            ], 404);
        }
    }
}
