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
                        'faculty' => $course->faculty->name
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
                        'course_code' => $enrolledCourse->course->course_code ?? null,
                        'course_title' => $enrolledCourse->course->course_title ?? null,
                        'course_program' => $enrolledCourse->course->section->program ?? null,
                        'course_year' => $enrolledCourse->course->section->year ?? null,
                        'course_block' => $enrolledCourse->course->section->block ?? null,
                        'course_facultyfname' => $enrolledCourse->course->faculty->first_name ?? null,
                        'course_facultylname' => $enrolledCourse->course->faculty->last_name ?? null,
                        'student_id' => $enrolledCourse->student_id,
                        'student_tag_uid' => $enrolledCourse->student->tag_uid ?? null,
                        'student_number' => $enrolledCourse->student->student_id ?? null,
                        'student_name' => $enrolledCourse->student->name ?? null,
                        'student_program' => $enrolledCourse->student->section->program ?? null,
                        'student_year' => $enrolledCourse->student->section->year ?? null,
                        'student_block' => $enrolledCourse->student->section->block ?? null,
                        'student_email' => $enrolledCourse->student->email ?? null,
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
