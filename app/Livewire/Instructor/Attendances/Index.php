<?php

namespace App\Livewire\Instructor\Attendances;

use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Schedules;
use App\Models\Attendance;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $selectedSection, $selectedSubject, $selectedDate;
    public $dlpdfsection_id, $dlpdfsubject_id, $dlpdfdate;

    public function updatedSelectedSection($value){
        $this->selectedSection = $value;
        // $this->selectedSubject = null;
        $this->resetPage();
    }

    public function updatedSelectedSubject($value){
        $this->selectedSubject = $value;
        $this->resetPage();
    }

    public function updatedSelectedDate($value){
        $this->selectedDate = $value;
        $this->resetPage();
    }

    public function downloadPDF(){
        // Image Paths
        $ccsimageData = base64_encode(file_get_contents(public_path('assets/images/ccs.png')));
        $ccsimageBase64 = 'data:image/jpeg;base64,' . $ccsimageData;

        $cspcimageData = base64_encode(file_get_contents(public_path('assets/images/cspc.png')));
        $cspcimageBase64 = 'data:image/jpeg;base64,' . $cspcimageData;

        $instructorId = Auth::id();
        //Fetch attendance pdf based on the Instructor Selected

        $query = Schedules::where('instructor_id', $instructorId)
                            // ->with('attendance.student') // Eager load relationships (Old Version)

                            ->with(['attendance' => function ($query) {
                                $query->where('isCurrent', '0'); //Filter attendance where isCurrent to 0
                                $query->where('date', 'like', '%'.$this->dlpdfdate.'%'); //Filter Date
                            }, 'attendance.student']) // Eager load relationships

                            ->when($this->dlpdfsection_id, function ($query) {
                                    $query->where('section_id', $this->dlpdfsection_id);
                            })

                            ->when($this->dlpdfsubject_id, function ($query) {
                                $query->where('subject_id', $this->dlpdfsubject_id);
                            });

        $schedules = $query->get();

        // Getting Values from the Dialog Dropdown and Retrieve into PDF.
        $subject = Subject::where('id', $this->dlpdfsubject_id)->value('subject_code');
        $program = Section::where('id', $this->dlpdfsection_id)->value('program');
        $year = Section::where('id', $this->dlpdfsection_id)->value('year');
        $block = Section::where('id', $this->dlpdfsection_id)->value('block');

        $data = [
            'title' => 'Attendance for Todays Vidwo!',
            'date' => $this->dlpdfdate,
            'schedules' => $schedules,
            'subject' => $subject,
            'section' => $program . ' ' . $year . $block,
            'ccsheader' => $ccsimageBase64,
            'cspcheader' => $cspcimageBase64
        ];

        $pdf = PDF::loadView('livewire.instructor.attendances.attendance', $data);

        $this->resetInput();
        $this->dispatch('close-modal');

        return response()->streamDownload(function() use($pdf){
            echo $pdf->stream();
        }, 'attendance.pdf');
    }

    public function resetInput(){
        $this->dlpdfsection_id = '';
        $this->dlpdfsubject_id = '';
        $this->dlpdfdate = '';
    }

    public function render(){

        $instructorId = Auth::id();

        // Fetch sections associated with schedules of the instructor (Dropdown Tag)
        $sections = Section::whereHas('schedules', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->get();

        // Fetch subjects associated with schedules of the instructor (Dropdown Tag)
        $subjects = Subject::whereHas('schedules', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->pluck('subject_name', 'id')->toArray();


        // Fetch schedules based on selected section (if any)
        $query = Schedules::where('instructor_id', $instructorId)
                            // ->with('attendance.student') // Eager load relationships (Old Version)

                            ->with(['attendance' => function ($query) {
                                $query->where('isCurrent', '0'); //Filter attendance where isCurrent to 0
                                $query->where('date', 'like', '%'.$this->selectedDate.'%'); //Filter Date
                            }, 'attendance.student']) // Eager load relationships

                            // Fetch Section based on Dropdown Selected
                            ->when($this->selectedSection, function ($query) {
                                    $query->where('section_id', $this->selectedSection);
                            })

                            // Fetch Subject Based on Dropdown Selected
                            ->when($this->selectedSubject, function ($query) {
                                $query->where('subject_id', $this->selectedSubject);
                            });

        $schedules = $query->get();

        return view('livewire.instructor.attendances.index',[
            'schedules' => $schedules,
            'subjects' => $subjects,
            'sections' => $sections
        ]);
    }
}
