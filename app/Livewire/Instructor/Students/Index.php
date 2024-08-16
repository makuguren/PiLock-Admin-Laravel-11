<?php

namespace App\Livewire\Instructor\Students;

use App\Models\Course;
use Livewire\Component;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $selectedCourseSection;

    public function updatedSelectedCourseSection($value){
        $this->selectedCourseSection = $value;
        // $this->resetPage();
    }

    public function render(){
        $instructorId = Auth::id();

        // Fetch Courses with Section associated with Courses of the instructor (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->with('section')->get();

        // Query to Show Courses where the Instructor is based to Current Loggedin with, Fetch the EnrolledCourse of the Student(Model).
        $query = Course::where('instructor_id', $instructorId)
            ->with('enrolledCourse.student')

            // Filter EnrolledCourses based on Dropdown Selected
            ->when($this->selectedCourseSection, function ($query) {
                $query->where('id', $this->selectedCourseSection);
            });

        $enrolledstuds = $query->get();

        return view('livewire.instructor.students.index', [
            'enrolledstuds' => $enrolledstuds,
            'courseSecs' => $courseSecs
        ]);
    }
}
