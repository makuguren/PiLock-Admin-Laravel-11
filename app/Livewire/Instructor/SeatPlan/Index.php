<?php

namespace App\Livewire\Instructor\SeatPlan;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\SeatPlan;
use App\Models\Schedules;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $selectedSection = null;
    public $selectedSubject = null;

    public $disabledSection, $disabledSubject = '';

    public $seat_id, $student_name, $seat_number;

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

    public function render(){
        $instructor_id = Auth::id();

        // Fetch sections associated with schedules of the instructor (Dropdown Tag)
        // $sections = Section::whereHas('schedules', function ($query) use ($instructor_id) {
        //     $query->where('instructor_id', $instructor_id);
        // })->get();

        $sections = Section::whereHas('course', function ($query) use ($instructor_id) {
            $query->where('instructor_id', $instructor_id);
        })->with('course')->get();

        // Fetch subjects associated with schedules of the instructor (Dropdown Tag)
        // $subjects = Subject::whereHas('schedules', function ($query) use ($instructor_id) {
        //     $query->where('instructor_id', $instructor_id);
        // })->pluck('subject_name', 'id')->toArray();


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



        // Query for Seatplan with student model order by seat number is ascending order.
        // $seatplans = SeatPlan::with('student')->orderBy('seat_number')->get();
        return view('livewire.instructor.seat-plan.index', [
            'seatplans' => $queryFetchSeats,
            'sections' => $sections,
            // 'subjects' => $subjects
        ]);
    }
}
