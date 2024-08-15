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

    public $selectedSection = null;
    public $selectedSubject = null;

    public $disabledSection, $disabledSubject = '';

    public function updatedSelectedSection($value){
        $this->selectedSection = $value;
        $this->selectedSubject = null;
        $this->disabledSection = 'disabled';
        // $this->resetPage();
    }

    public function updatedSelectedSubject($value){
        $this->selectedSubject = $value;
        $this->disabledSubject = 'disabled';
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

    public function updateSeat($student_id, $seat_number){
        $updateSeat = SeatPlan::where('student_id', $student_id);
        $seatQuery = $updateSeat->get();

        if($seatQuery->isNotEmpty()){
            $updateSeat->update([
                'seat_number' => $seat_number
            ]);
            toastr()->success('Updated Seat Number Successfully');
        } else {
            toastr()->error('No Seats Number Found!');
        }
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

        // Fetch sections associated with schedules of the instructor (Dropdown Tag)
        $sections = Section::whereHas('course', function ($query) use ($instructor_id) {
            $query->where('instructor_id', $instructor_id);
        })->with('course')->get();

        // Fetch subjects associated with schedules of the instructor (Dropdown Tag)
        // $subjects = Subject::whereHas('schedules', function ($query) use ($instructor_id) {
        //     $query->where('instructor_id', $instructor_id);
        // })->pluck('subject_name', 'id')->toArray();


        // Query to Fetch Attendances
        $queryFetchStudents = Course::where('instructor_id', $instructor_id)
                            ->with(['seatplan' => function ($query) {
                                $query->whereNull('seat_number');
                                $query->orderBy('seat_number');
                            }, 'seatplan.student'])

                            // Fetch Section based on Dropdown Selected
                            ->when($this->selectedSection, function ($query) {
                                    $query->where('section_id', $this->selectedSection);
                            })

                            // Fetch Subject Based on Dropdown Selected
                            ->when($this->selectedSubject, function ($query) {
                                $query->where('subject_id', $this->selectedSubject);
                            });

                            // Return an empty collection if no section and subject are selected
                            if (is_null($this->selectedSection) && is_null($this->selectedSubject)) {
                                $queryFetchStudents = collect();
                            } else {
                                $queryFetchStudents = $queryFetchStudents->get();
                            }


        $queryFetchSeats = Course::where('instructor_id', $instructor_id)
                            ->with(['seatplan' => function ($query) {
                                $query->orderBy('seat_number');
                            }, 'seatplan.student'])

                            // Fetch Section based on Dropdown Selected
                            ->when($this->selectedSection, function ($query) {
                                $query->where('section_id', $this->selectedSection);
                            })

                            // Fetch Subject Based on Dropdown Selected
                            ->when($this->selectedSubject, function ($query) {
                                $query->where('subject_id', $this->selectedSubject);
                            });

                            // Return an empty collection if no section and subject are selected
                            if (is_null($this->selectedSection) && is_null($this->selectedSubject)) {
                                $queryFetchSeats = collect();
                            } else {
                                $queryFetchSeats = $queryFetchSeats->get();
                            }

        return view('livewire.instructor.seat-plan.edit', [
            'seatplans' => $queryFetchSeats,
            'fetchStudentsList' => $queryFetchStudents,
            'sections' => $sections,
            // 'subjects' => $subjects
        ])->layout('instructor.layouts.seatplan');
    }
}
