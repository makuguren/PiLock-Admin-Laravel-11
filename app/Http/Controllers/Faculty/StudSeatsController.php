<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Course;
use App\Models\SeatPlan;
use Illuminate\Http\Request;

use function Termwind\render;
use App\Http\Controllers\Controller;

class StudSeatsController extends Controller
{
    public function index($course_id){
        // Image Paths
        $ccsimageData = base64_encode(file_get_contents(public_path('assets/images/ccs.png')));
        $ccsimageBase64 = 'data:image/jpeg;base64,' . $ccsimageData;

        $cspcimageData = base64_encode(file_get_contents(public_path('assets/images/cspc.png')));
        $cspcimageBase64 = 'data:image/jpeg;base64,' . $cspcimageData;

        $seatStuds = SeatPlan::where('course_id', $course_id)
            ->join('users', 'seat_plan.student_id', '=', 'users.id')
            ->select('seat_plan.*', 'users.first_name', 'users.last_name')
            ->orderBy('seat_number', 'ASC')
            ->get();

        $course = Course::findOrFail($course_id);

        if ($seatStuds->isNotEmpty()) {
            $facultyTitle = $course->faculty->gender === '1' ? 'Mr.' : ($course->faculty->gender === '2' ? 'Ms.' : '');

            $data = [
                'seatStuds' => $seatStuds,
                'ccsimageBase64' => $ccsimageBase64,
                'cspcimageBase64' => $cspcimageBase64,
                'subject' => $course->course_title,
                'section' => $course->section->program . ' ' . $course->section->year . $course->section->block,
                'faculty' => $facultyTitle . ' ' . $course->faculty->first_name . ' ' . $course->faculty->last_name,
            ];
            return view('livewire.faculty.seat-plan.seatstud', $data);
        } else {
            abort(404);
        }
    }
}
