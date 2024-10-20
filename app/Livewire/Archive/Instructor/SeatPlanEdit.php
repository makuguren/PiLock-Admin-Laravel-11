<?php

namespace App\Livewire\Archive\Instructor;

use App\Models\Archive\User;
use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use Livewire\Component;
use App\Models\Archive\SeatPlan;
use App\Models\Archive\Schedules;
use App\Models\Archive\EnrolledCourse;
use Illuminate\Support\Facades\Auth;

class SeatPlanEdit extends Component
{
    public $seat_id, $student_name, $seat_number;
    public $subject_id, $course_id;

    public $selectedCourseSection = null;

    public $disabledSection, $disabledSubject = '';

    public function updatedSelectedCourseSection($value){
        $this->disabledSection = 'disabled';
        $this->selectedCourseSection = $value;
    }

    public function viewSeat($seat_id){
        // View the Modal
        $this->dispatch('view_seat_modal');

        $seatQuery = SeatPlan::findOrFail($seat_id);

        if($seatQuery){
            $this->seat_id = $seatQuery->id;
            $this->student_name = $seatQuery->student->first_name . ' ' . $seatQuery->student->last_name;
            $this->seat_number = $seatQuery->seat_number;
        }
    }

    public function render(){
        $instructor_id = Auth::id();

        // Fetch Courses with Section associated with Courses of the instructor (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($instructor_id) {
            $query->where('instructor_id', $instructor_id);
        })->with('section')->get();

        // Query to Show Courses where the Instructor is based to Current Loggedin with, Fetch the SeatPlan of the Student(Model).
        $queryFetchStudents = Course::where('instructor_id', $instructor_id)
                ->with(['seatplan' => function ($query) {
                    $query->whereNull('seat_number');
                    $query->orderBy('seat_number');
                }, 'seatplan.student'])

                // Filter Seatplan(Students) from Course(Course_id) based on Dropdown Selected
                ->when($this->selectedCourseSection, function ($query) {
                        $query->where('id', $this->selectedCourseSection);
                });

                // Return an empty collection if no courses and section are selected
                if (is_null($this->selectedCourseSection)) {
                    $queryFetchStudents = collect();
                } else {
                    $queryFetchStudents = $queryFetchStudents->get();
                }


        $queryFetchSeats = Course::where('instructor_id', $instructor_id)
                ->with(['seatplan' => function ($query) {
                    $query->orderBy('seat_number');
                }, 'seatplan.student'])

                // Filter Seatplan(Students) from Course(Course_id) based on Dropdown Selected
                ->when($this->selectedCourseSection, function ($query) {
                    $query->where('id', $this->selectedCourseSection);
                });

                // Return an empty collection if no courses and section are selected
                if (is_null($this->selectedCourseSection)) {
                    $queryFetchSeats = collect();
                } else {
                    $queryFetchSeats = $queryFetchSeats->get();
                }

        return view('livewire.archive.instructor.seatplan-edit', [
            'seatplans' => $queryFetchSeats,
            'fetchStudentsList' => $queryFetchStudents,
            'courseSecs' => $courseSecs,
        ])->layout('archive.instructor.layouts.seatplan');
    }
}
