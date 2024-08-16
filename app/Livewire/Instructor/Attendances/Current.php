<?php

namespace App\Livewire\Instructor\Attendances;

use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Current extends Component
{
    use WithPagination;

    public $selectedCourseSection, $selectedSubject, $selectedDate;

    public function updatedSelectedCourseSection($value){
        $this->selectedCourseSection = $value;
        // $this->selectedSubject = null;
        $this->resetPage();
    }

    public function updatedSelectedDate($value){
        $this->selectedDate = $value;
        $this->resetPage();
    }

    public function render(){

        $instructorId = Auth::id();

        // Fetch Courses with Section associated with Courses of the instructor (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->with('section')->get();

        // Query to Show Courses where the Instructor is based to Current Loggedin with, Fetch the Attendances of the Student(Model).
        $query = Course::where('instructor_id', $instructorId)
            // ->with('attendance.student') // Eager load relationships (Old Version)

            ->with(['attendance' => function ($query) {
                $query->where('isCurrent', '1'); //Filter attendance where isCurrent to 0
                $query->where('date', 'like', '%'.$this->selectedDate.'%'); //Filter Date
            }, 'attendance.student']) // Eager load relationships

            // Filter Attendances(Students) from Course(Course_id) based on Dropdown Selected
            ->when($this->selectedCourseSection, function ($query) {
                    $query->where('id', $this->selectedCourseSection);
            });

        $courses = $query->get();

        return view('livewire.instructor.attendances.current',[
            'courses' => $courses,
            'courseSecs' => $courseSecs
        ]);
    }
}
