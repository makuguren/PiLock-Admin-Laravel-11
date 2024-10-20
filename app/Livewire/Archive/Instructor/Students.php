<?php

namespace App\Livewire\Archive\Instructor;

use App\Models\Archive\BlockedStudentCourses;
use App\Models\Archive\User;
use App\Models\Archive\Course;
use Livewire\Component;
use App\Models\Archive\EnrolledCourse;
use Illuminate\Support\Facades\Auth;

class Students extends Component
{
    public $selectedCourseSection;
    public $enroll_id, $student_id, $course_id, $search_student, $first_name, $last_name, $section, $blkcourse_id, $blkstudent_id;

    public function updatedSelectedCourseSection($value){
        $this->selectedCourseSection = $value;
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

        return view('livewire.archive.instructor.students', [
            'enrolledstuds' => $enrolledstuds,
            'courseSecs' => $courseSecs
        ]);
    }
}
