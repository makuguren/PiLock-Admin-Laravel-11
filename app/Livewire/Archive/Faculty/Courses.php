<?php

namespace App\Livewire\Archive\Faculty;

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
        $courses = Course::where('faculty_id', Auth::user()->id)->get();
        return view('livewire.archive.faculty.courses', [
            'courses' => $courses,
            'cpCourseKey' => $this->cpCourseKey,
        ]);
    }
}
