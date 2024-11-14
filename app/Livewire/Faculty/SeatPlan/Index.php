<?php

namespace App\Livewire\Faculty\SeatPlan;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\SeatPlan;
use App\Models\Schedules;
use Livewire\Attributes\On;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $selectedCourseSection = null, $selectedDLCourseSection;
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

    public function downloadSeatPlan(){

        // // Image Paths
        // $ccsimageData = base64_encode(file_get_contents(public_path('assets/images/ccs.png')));
        // $ccsimageBase64 = 'data:image/jpeg;base64,' . $ccsimageData;

        // $cspcimageData = base64_encode(file_get_contents(public_path('assets/images/cspc.png')));
        // $cspcimageBase64 = 'data:image/jpeg;base64,' . $cspcimageData;

        // $seatStuds = SeatPlan::where('course_id', $this->selectedDLCourseSection)
        //     ->join('users', 'seat_plan.student_id', '=', 'users.id')
        //     ->select('seat_plan.*', 'users.first_name', 'users.last_name')
        //     ->orderBy('seat_number', 'ASC')
        //     ->get();

        return redirect()->route('faculty.seatplan.seatstuds', $this->selectedDLCourseSection);

        // $data = [
        //     'title' => 'Downloaded Seat Plan',
        //     'seatStuds' => $seatStuds,
        //     'ccsheader' => $ccsimageBase64,
        //     'cspcheader' => $cspcimageBase64
        // ];

        // $pdf = Pdf::loadView('livewire.faculty.seat-plan.seatstud', $data);
        // $this->dispatch('close-modal');

        // return response()->streamDownload(function() use($pdf){
        //     echo $pdf->stream();
        // }, 'student_seats.pdf');
    }

    public function render(){
        $facultyId = Auth::id();

        $courseSecs = Course::whereHas('section', function ($query) use ($facultyId) {
            $query->where('faculty_id', $facultyId);
        })->with('section')->get();

        $queryFetchSeats = Course::where('faculty_id', $facultyId)
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
        return view('livewire.faculty.seat-plan.index', [
            'seatplans' => $queryFetchSeats,
            'courseSecs' => $courseSecs,
        ]);
    }
}
