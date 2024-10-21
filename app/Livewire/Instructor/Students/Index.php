<?php

namespace App\Livewire\Instructor\Students;

use App\Models\User;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;
use App\Models\BlockedStudentCourses;

class Index extends Component
{
    use WithPagination;

    public $selectedCourseSection;
    public $enroll_id, $student_id, $course_id, $search_student, $first_name, $last_name, $section, $blkcourse_id, $blkstudent_id;

    public $sortField = 'users.last_name';
    public $sortDirection = 'asc';

    public function updatedSelectedCourseSection($value){
        $this->selectedCourseSection = $value;
        // $this->resetPage();
    }

    public function findStudent(){
        $student = User::where('student_id', $this->search_student)->first();
        if($student) {
            $this->student_id = $student->id;
            $this->first_name = $student->first_name;
            $this->last_name = $student->last_name;
            $this->section = $student->section->program . ' ' . $student->section->year . $student->section->block;
        } else {
            toastr()->error("Can't Find Student!");
        }
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

    public function addStudCourse(){
        $validatedData = $this->validate([
            'course_id' => 'required|integer',
        ]);

        EnrolledCourse::create([
            'course_id' => $validatedData['course_id'],
            'student_id' => $this->student_id
        ]);

        toastr()->success("Student Added Successfully!");
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function unenrollStud(int $enroll_id){
        $this->enroll_id = $enroll_id;
    }

    public function destroyEnrolledStud(){
        EnrolledCourse::findOrFail($this->enroll_id)->delete();

        toastr()->success("Student Added Successfully!");
        $this->dispatch('close-modal');
    }

    public function blockStudCourse(int $student_id, int $course_id, int $enroll_id){
        $this->blkstudent_id = $student_id;
        $this->blkcourse_id = $course_id;
        $this->enroll_id = $enroll_id;
    }

    public function destroyEnrollNBlockStud(){
        BlockedStudentCourses::create([
            'student_id' => $this->blkstudent_id,
            'course_id' => $this->blkcourse_id,
        ]);

        EnrolledCourse::findOrFail($this->enroll_id)->delete();

        toastr()->success("Student has been blocked Successfully!");
        $this->dispatch('close-modal');
    }

    public function resetInput(){
        $this->search_student = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->section = '';
        $this->course_id = '';
    }

    public function render(){
        $instructorId = Auth::id();

        // Fetch Courses with Section associated with Courses of the instructor (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->with('section')->get();

        $getCourseId = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->pluck('id')->toArray();

        $enrolledstuds = EnrolledCourse::whereIn('course_id', $getCourseId)
            ->join('users', 'enrolledcourses.student_id', '=', 'users.id')
            ->select('enrolledcourses.*', 'users.first_name', 'users.last_name')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.instructor.students.index', [
            'enrolledstuds' => $enrolledstuds,
            'courseSecs' => $courseSecs
        ]);
    }
}
