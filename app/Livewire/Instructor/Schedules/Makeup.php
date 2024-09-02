<?php

namespace App\Livewire\Instructor\Schedules;

use App\Models\Course;
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
    public $schedule_id, $course_id, $days, $time_start, $time_end;
    public $instructor_name;

    //Validations
    protected function rules(){
        return [
            'course_id' => 'required|integer',
            'days' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'time_start' => 'required',
            'time_end' => 'required'
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    public function fetchCourseDetails(int $course_id){
        $fetchCourse = Course::find($course_id);
        if($fetchCourse){
            $this->instructor_name = $fetchCourse->instructor->name;
        }
    }

    //Save Schedule
    public function saveSchedule(){
        $validatedData = $this->validate();

        $scheduleData = [
            'course_id' => $validatedData['course_id'],
            'days' => $validatedData['days'],
            'time_start' => $validatedData['time_start'],
            'time_end' => $validatedData['time_end'],
            'isApproved' => '0',
            'isMakeUp' => '1',
            'isCurrent' => '0'
        ];

        Schedules::create($scheduleData);

        toastr()->success('Make-Up Schedule Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Edit Schedule
    public function editSchedule(int $schedule_id){
        $schedule = Schedules::find($schedule_id);
        if($schedule){
            $this->schedule_id = $schedule->id;
            $this->course_id = $schedule->course_id;
            $this->instructor_name = $schedule->course->instructor->name;
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
            'course_id' => $validatedData['course_id'],
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
        $this->course_id = '';
        $this->days = '';
        $this->time_start = '';
        $this->time_end = '';
    }


    public function render(){
        $subjects = Subject::all();
        $sections = Section::all();

        $query = Course::where('instructor_id', Auth::id())
        ->with(['schedule' => function ($query) {
            $query->where('isMakeUp', '1');
        }, 'schedule']);

        $courses = $query->paginate(10);

        return view('livewire.instructor.schedules.makeup', [
            'courses' => $courses,
            'subjects' => $subjects,
            'sections' => $sections
        ]);
    }
}
