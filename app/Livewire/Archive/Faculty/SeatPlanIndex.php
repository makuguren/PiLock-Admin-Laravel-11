<?php

namespace App\Livewire\Archive\Faculty;

use App\Models\Archive\User;
use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use Livewire\Component;
use App\Models\Archive\SeatPlan;
use App\Models\Archive\Schedules;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class SeatPlanIndex extends Component
{
    public $selectedCourseSection = null;
    public $disabledSection, $disabledSubject = '';

    public $seat_id, $student_name, $seat_number;

    public function updatedSelectedCourseSection($value){
        $this->disabledSection = 'disabled';
        $this->selectedCourseSection = $value;
        // $this->selectedSubject = null;
        // $this->resetPage();
    }

    public function viewSeat($seat_id){
        // View the Modal
        $this->dispatch('preview_seat_modal');

        $seatQuery = SeatPlan::findOrFail($seat_id);

        if($seatQuery){
            $this->seat_id = $seatQuery->id;
            $this->student_name = $seatQuery->student->first_name . ' ' . $seatQuery->student->last_name;
            $this->seat_number = $seatQuery->seat_number;
        }
    }

    public function render(){
        $faculty_id = Auth::id();

        $courseSecs = Course::whereHas('section', function ($query) use ($faculty_id) {
            $query->where('faculty_id', $faculty_id);
        })->with('section')->get();

        $queryFetchSeats = Course::where('faculty_id', $faculty_id)
            ->with(['seatplan' => function ($query) {
                $query->orderBy('seat_number');
            }, 'seatplan.student'])

            // Fetch Section based on Dropdown Selected
            ->when($this->selectedCourseSection, function ($query) {
                $query->where('id', $this->selectedCourseSection);
            });

            // Return an empty collection if no courses and section are selected
            if (is_null($this->selectedCourseSection)) {
                $queryFetchSeats = collect();
            } else {
                $queryFetchSeats = $queryFetchSeats->get();
            }


        // Query for Seatplan with student model order by seat number is ascending order.
        // $seatplans = SeatPlan::with('student')->orderBy('seat_number')->get();
        return view('livewire.archive.faculty.seatplan', [
            'seatplans' => $queryFetchSeats,
            'courseSecs' => $courseSecs,
        ]);
    }
}
