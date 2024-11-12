<?php

namespace App\Livewire\Faculty\Courses;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\BlockedStudentCourses;

class BlockedStudents extends Component
{
    public $selectedCourseSection, $course_id;

    public function updatedSelectedCourseSection($value){
        $this->selectedCourseSection = $value;
        // $this->selectedSubject = null;
        // $this->resetPage();
    }

    public function unblockStudCourse(int $course_id){
        $this->course_id = $course_id;
    }

    public function destroyUnblckStudCourse(){
        BlockedStudentCourses::findOrFail($this->course_id)->delete();
        toastr()->success('Student Unblocked Successfully');
        $this->dispatch('close-modal');
    }

    public function render(){
        $facultyId = Auth::id();

        // Fetch Courses with Section associated with Courses of the Faculty (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($facultyId) {
            $query->where('faculty_id', $facultyId);
        })->with('section')->get();

        // Another Method of Query to Fetch Blocked Courses based Faculty Current LoggedIn
        // Fetch Course IDs of the Faculty (based on Course-Section relationship)
        $getCourseId = Course::whereHas('section', function ($query) use ($facultyId) {
            $query->where('faculty_id', $facultyId);
        })->pluck('id')->toArray();

        // Fetch Blocked Courses based on the course IDs, where 'isCurrent'
        $blockedCourses = BlockedStudentCourses::whereIn('course_id', $getCourseId)

            // Selected CourseID(Course Subject with Section) on Dropdown
            ->when($this->selectedCourseSection, function ($query) {
                $query->where('course_id', $this->selectedCourseSection);
            })

            ->with('student') // Eager load the student relationship (Modal)
            ->get();

        return view('livewire.faculty.courses.block-students', [
            'courseSecs' => $courseSecs,
            'blockedCourses' => $blockedCourses
        ]);
    }
}
