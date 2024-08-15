<?php

namespace App\Livewire\Instructor\Students;

use App\Models\Course;
use Livewire\Component;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function render(){
        $instructorId = Auth::id();

        // $enrolledstuds = EnrolledCourse::all();
        $query = Course::where('instructor_id', $instructorId)
                    ->with('enrolledCourse.student');

        $enrolledstuds = $query->get();

        return view('livewire.instructor.students.index', [
            'enrolledstuds' => $enrolledstuds
        ]);
    }
}
