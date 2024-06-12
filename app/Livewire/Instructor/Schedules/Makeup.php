<?php

namespace App\Livewire\Instructor\Schedules;

use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Instructor;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Makeup extends Component
{
    use WithPagination;
    public $schedule_id, $subject_id, $section_id, $days, $time_start, $time_end;

    //Validations
    protected function rules(){
        return [
            'subject_id' => 'required|integer',
            'section_id' => 'required|integer',
            'days' => 'required|string',
            'time_start' => 'required',
            'time_end' => 'required'
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    //Save Schedule
    public function saveSchedule(){
        $validatedData = $this->validate();

        Schedules::create([
            'subject_id' => $validatedData['subject_id'],
            'instructor_id' => Auth::user()->id,
            'section_id' => $validatedData['section_id'],
            'days' => $validatedData['days'],
            'time_start' => $validatedData['time_start'],
            'time_end' => $validatedData['time_end'],
            'isApproved' => '0',
            'isMakeUp' => '1'
        ]);

        toastr()->success('Make-Up Schedule Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Edit Schedule
    public function editSchedule(int $schedule_id){
        $schedule = Schedules::find($schedule_id);
        if($schedule){
            $this->schedule_id = $schedule->id;
            $this->subject_id = $schedule->subject_id;
            $this->section_id = $schedule->section_id;
            $this->days = $schedule->days;
            $this->time_start = $schedule->time_start;
            $this->time_end = $schedule->time_end;
        } else {
            return redirect()->to('/makeupscheds');
        }
    }

    public function updateSchedule(){
        $validatedData = $this->validate();

        Schedules::where('id', $this->schedule_id)->update([
            'subject_id' => $validatedData['subject_id'],
            'instructor_id' => Auth::user()->id,
            'section_id' => $validatedData['section_id'],
            'days' => $validatedData['days'],
            'time_start' => $validatedData['time_start'],
            'time_end' => $validatedData['time_end'],
            'isMakeUp' => '1'
        ]);

        toastr()->success('Make-Up Schedule Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Delete Schedule
    public function deleteSchedule(int $schedule_id){
        $this->schedule_id = $schedule_id;
    }

    public function destroySchedule(){
        Schedules::find($this->schedule_id)->delete();
        toastr()->success('Make-Up Schedule Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function resetInput(){
        $this->subject_id = '';
        $this->section_id = '';
        $this->days = '';
        $this->time_start = '';
        $this->time_end = '';
    }


    public function render(){
        $subjects = Subject::all();
        $sections = Section::all();
        $schedules = Schedules::where('isMakeUp', '1')->where('instructor_id', Auth::user()->id)->paginate(10);
        return view('livewire.instructor.schedules.makeup', [
            'schedules' => $schedules,
            'subjects' => $subjects,
            'sections' => $sections
        ]);
    }
}
