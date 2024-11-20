<?php

namespace App\Livewire\Archive\Faculty;

use App\Models\Archive\BlockedStudentCourses;
use App\Models\Archive\User;
use App\Models\Archive\Course;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Archive\EnrolledCourse;
use Illuminate\Support\Facades\Auth;

class Students extends Component
{
    use WithPagination;

    public $selectedCourseSection;
    public $enroll_id, $student_id, $course_id, $search_student, $first_name, $last_name, $section, $blkcourse_id, $blkstudent_id;

    public $sortField = 'users.last_name';
    public $sortDirection = 'asc';

    public function updatedSelectedCourseSection($value){
        $this->selectedCourseSection = $value;
    }

    // Dynamic Table for Sorting
    public function sortBy($field){
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render(){
        $facultyId = Auth::id();

        // Fetch Courses with Section associated with Courses of the Faculty (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($facultyId) {
            $query->where('faculty_id', $facultyId);
        })->with('section')->get();

        $getCourseId = Course::whereHas('section', function ($query) use ($facultyId) {
            $query->where('faculty_id', $facultyId);
        })->pluck('id')->toArray();

        $enrolledstuds = EnrolledCourse::whereIn('course_id', $getCourseId)
            ->join('users', 'enrolledcourses.student_id', '=', 'users.id')
            ->select('enrolledcourses.*', 'users.first_name', 'users.last_name')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.archive.faculty.students', [
            'enrolledstuds' => $enrolledstuds,
            'courseSecs' => $courseSecs
        ]);
    }
}
