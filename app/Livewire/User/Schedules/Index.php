<?php

namespace App\Livewire\User\Schedules;

use Livewire\Component;
use App\Models\Schedules;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function render(){
        // Retrieve Schedules by Enrolled Courses
        $getCourseId = EnrolledCourse::where('student_id', Auth::id())->pluck('course_id')->toArray();
        $schedules = Schedules::whereIn('course_id', $getCourseId)->get();

        return view('livewire.user.schedules.index', [
            'schedules' => $schedules
        ]);
    }
}
