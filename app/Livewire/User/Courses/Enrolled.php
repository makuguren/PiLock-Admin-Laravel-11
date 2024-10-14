<?php

namespace App\Livewire\User\Courses;

use Livewire\Component;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;

class Enrolled extends Component
{
    public $course_id, $course_title;

    public function getEnrolledCourseID(int $course_id){
        $course = EnrolledCourse::findOrFail($course_id);
        if($course) {
            $this->course_id = $course->id;
            $this->course_title = $course->course->course_title;
        } else {
            return redirect()->to('/courses/enrolledcourses');
        }
    }

    public function destroyEnrolledCourse(){
        EnrolledCourse::findOrfail($this->course_id)->delete();
        toastr()->success('Unenrolled Successfully!');
        $this->dispatch('close-modal');
    }

    public function render(){
        $enrolledCourses = EnrolledCourse::where('student_id', Auth::id())->get();
        return view('livewire.user.courses.enrolled', [
            'enrolledCourses' => $enrolledCourses,
        ]);
    }
}
