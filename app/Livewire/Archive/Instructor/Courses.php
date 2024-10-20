<?php

namespace App\Livewire\Archive\Instructor;

use App\Models\Archive\Course;
use App\Models\Archive\Section;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Courses extends Component
{
    public $cpCourseKey;

    public function copyEnrollmentKey(String $enrollmentKey){
        $this->cpCourseKey = $enrollmentKey;
    }

    public function render(){
        $courses = Course::where('instructor_id', Auth::user()->id)->get();
        return view('livewire.archive.instructor.courses', [
            'courses' => $courses,
            'cpCourseKey' => $this->cpCourseKey,
        ]);
    }
}
