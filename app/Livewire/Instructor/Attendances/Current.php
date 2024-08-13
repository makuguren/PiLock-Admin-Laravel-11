<?php

namespace App\Livewire\Instructor\Attendances;

use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Current extends Component
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
                                $query->where('isCurrent', '1'); //Filter attendance where isCurrent to 0
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

        return view('livewire.instructor.attendances.current', [
            'schedules' => $schedules,
            'subjects' => $subjects,
            'sections' => $sections
        ]);
    }
}
