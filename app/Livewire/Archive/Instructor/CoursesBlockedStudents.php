<?php

namespace App\Livewire\Archive\Instructor;

use App\Models\Archive\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Archive\BlockedStudentCourses;

class CoursesBlockedStudents extends Component
{
    public $selectedCourseSection, $course_id;

    public function updatedSelectedCourseSection($value){
        $this->selectedCourseSection = $value;
    }

    public function render(){
        $instructorId = Auth::id();

        // Fetch Courses with Section associated with Courses of the instructor (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->with('section')->get();

        // Another Method of Query to Fetch Blocked Courses based Instructor Current LoggedIn
        // Fetch Course IDs of the instructor (based on Course-Section relationship)
        $getCourseId = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->pluck('id')->toArray();

        // Fetch Blocked Courses based on the course IDs, where 'isCurrent'
        $blockedCourses = BlockedStudentCourses::whereIn('course_id', $getCourseId)

            // Selected CourseID(Course Subject with Section) on Dropdown
            ->when($this->selectedCourseSection, function ($query) {
                $query->where('course_id', $this->selectedCourseSection);
            })

            ->with('student') // Eager load the student relationship (Modal)
            ->get();

        return view('livewire.archive.instructor.courses-blocked', [
            'courseSecs' => $courseSecs,
            'blockedCourses' => $blockedCourses
        ]);
    }
}
