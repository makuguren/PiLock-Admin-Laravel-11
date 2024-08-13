<?php

namespace App\Livewire\Instructor\SeatPlan;

use App\Models\User;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\SeatPlan;
use App\Models\Schedules;
use Illuminate\Support\Facades\Auth;

class EditSP extends Component
{
    public $seat_id, $student_name, $seat_number;
    public $subject_id, $section_id;

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
        $schedule = Schedules::where('subject_id', $this->subject_id)->where('section_id', $this->section_id)->first();
        $students = User::where('section_id', $this->section_id)->get();

        if($schedule){
            foreach ($students as $student) {

                SeatPlan::updateOrCreate([
                    'student_id' => $student->id,
                    'schedule_id' => $schedule->id
                ]);

                toastr()->success('Load Students Successfully!');
                $this->dispatch('close-modal');
            }
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
        $sections = Section::whereHas('schedules', function ($query) use ($instructor_id) {
            $query->where('instructor_id', $instructor_id);
        })->get();

        // Fetch subjects associated with schedules of the instructor (Dropdown Tag)
        $subjects = Subject::whereHas('schedules', function ($query) use ($instructor_id) {
            $query->where('instructor_id', $instructor_id);
        })->pluck('subject_name', 'id')->toArray();


        // Query to Fetch Attendances
        $queryFetchStudents = Schedules::where('instructor_id', $instructor_id)
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


        $queryFetchSeats = Schedules::where('instructor_id', $instructor_id)
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
            'subjects' => $subjects
        ])->layout('instructor.layouts.seatplan');
    }
}
