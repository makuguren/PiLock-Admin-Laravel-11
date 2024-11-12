<?php

namespace App\Livewire\Admin\Schedules;

use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Faculty;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class Makeup extends Component
{
    use WithPagination;
    public $schedule_id, $course_id, $days, $time_start, $time_end;
    public $faculty_fname, $faculty_lname;

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
            $this->faculty_fname = $fetchCourse->faculty->first_name;
            $this->faculty_lname = $fetchCourse->faculty->last_name;
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
            'isApproved' => '1',
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
            $this->faculty_fname = $schedule->course->faculty->first_name;
            $this->faculty_lname = $schedule->course->faculty->last_name;
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
        try{
            Schedules::find($this->schedule_id)->delete();
            toastr()->success('Make-Up Schedule Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException $ex){
            toastr()->error('Unable to Delete Make-Up Schedule!'  . $ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function resetInput(){
        $this->course_id = '';
        $this->days = '';
        $this->time_start = '';
        $this->time_end = '';
    }

    public function render(){
        $faculties = Faculty::all();
        $sections = Section::all();
        $courses = Course::all();
        $schedules = Schedules::where('isMakeUp', '1')->where('isApproved', '1')->paginate(10);
        return view('livewire.admin.schedules.makeup' , [
            'schedules' => $schedules,
            'courses' => $courses,
            'faculties' => $faculties,
            'sections' => $sections
        ]);
    }
}
