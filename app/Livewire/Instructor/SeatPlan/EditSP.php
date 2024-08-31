<?php

namespace App\Livewire\Instructor\SeatPlan;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\SeatPlan;
use App\Models\Schedules;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;

class EditSP extends Component
{
    public $seat_id, $student_name, $seat_number;
    public $subject_id, $course_id;

    public $selectedCourseSection = null;

    public $disabledSection, $disabledSubject = '';

    public function updatedSelectedCourseSection($value){
        $this->disabledSection = 'disabled';
        $this->selectedCourseSection = $value;
        // $this->selectedSubject = null;
        // $this->resetPage();
    }

    public function loadStudentsData(){
        // Retrieve Course ID from the Dropdown
        // dd('Course ID: ' . $this->course_id);

        $courses = Course::where('id', $this->course_id)->first();
        $enrolledCourses = EnrolledCourse::where('course_id', $this->course_id)->get();

        if($courses){
            foreach ($enrolledCourses as $enrolledCourse) {

                SeatPlan::updateOrCreate([
                    'student_id' => $enrolledCourse->student_id,
                    'course_id' => $enrolledCourse->course_id
                ]);
            }

            toastr()->success('Load Students Successfully!');
            $this->dispatch('close-modal');

        } else {
            dd("No Schedules Found!");
        }
    }

    public function updateSeat($student_id, $seat_number)
    {
        // dd($this->selectedCourseSection);
        // Check if the seat number is already occupied
        $existingSeatPlan = SeatPlan::where('course_id', $this->selectedCourseSection)->where('seat_number', $seat_number)->first();

        if ($existingSeatPlan) {
            // If seat is occupied, handle the situation
            toastr()->error('The seat is already occupied!');
            return;
        }

        // Update or create the seat plan for the student
        $seatPlan = SeatPlan::updateOrCreate(
            ['student_id' => $student_id],
            ['seat_number' => $seat_number]
        );

        toastr()->success('Updated Seat Number Successfully');
    }

    public function viewSeat($seat_id){
        // View the Modal
        $this->dispatch('view_seat_modal');

        $seatQuery = SeatPlan::findOrFail($seat_id);

        if($seatQuery){
            $this->seat_id = $seatQuery->id;
            $this->student_name = $seatQuery->student->name;
            $this->seat_number = $seatQuery->seat_number;
        }
    }

    public function destroySeat($seat_id){
        $seatQuery = SeatPlan::findOrFail($seat_id);

        $seatQuery->update([
            'seat_number' => NULL
        ]);

        toastr()->success('Seat Number Deleted Successfully!');
        $this->dispatch('close-modal');
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

        return view('livewire.instructor.seat-plan.edit', [
            'seatplans' => $queryFetchSeats,
            'fetchStudentsList' => $queryFetchStudents,
            'courseSecs' => $courseSecs,
            // 'subjects' => $subjects
        ])->layout('instructor.layouts.seatplan');
    }
}
