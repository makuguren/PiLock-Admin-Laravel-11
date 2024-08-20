<?php

namespace App\Livewire\Instructor\Students;

use App\Models\User;
use App\Models\Course;
use Livewire\Component;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $selectedCourseSection;
    public $enroll_id, $student_id, $course_id, $search_student, $name, $section;

    public function updatedSelectedCourseSection($value){
        $this->selectedCourseSection = $value;
        // $this->resetPage();
    }

    public function findStudent(){
        $student = User::where('name', $this->search_student)->first();
        if($student) {
            $this->student_id = $student->id;
            $this->name = $student->name;
            $this->section = $student->section->program . ' ' . $student->section->year . $student->section->block;
        } else {
            toastr()->error("Can't Find Student!");
        }
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

    public function resetInput(){
        $this->search_student = '';
        $this->name = '';
        $this->section = '';
        $this->course_id = '';
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
