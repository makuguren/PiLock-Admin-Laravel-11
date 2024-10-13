<?php

namespace App\Livewire\Admin\MakeupSched;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Instructor;
use Livewire\WithPagination;
use App\Models\MakeupSchedule;
use App\Rules\NoMakeupSchedOverlap;
use Illuminate\Database\QueryException;

class Index extends Component
{
    use WithPagination;
    public $schedule_id, $course_id, $days, $time_start, $time_end, $lateDuration;
    public $course_code, $instructor_fname, $instructor_lname;

    //Validations
    protected function rules(){
        return [
            'course_id' => 'required|integer',
            'days' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'time_start' => 'required',
            'time_end' => [
                'required',
                new NoMakeupSchedOverlap($this->course_id, $this->days, $this->time_start, $this->time_end)
            ],
            'lateDuration' => 'nullable|numeric|min:0|max:60',
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    public function fetchCourseDetails(int $course_id){
        $fetchCourse = Course::find($course_id);
        if($fetchCourse){
            $this->course_code = $fetchCourse->course_code;
            $this->instructor_fname = $fetchCourse->instructor->first_name;
            $this->instructor_lname = $fetchCourse->instructor->last_name;
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
            'lateDuration' => $validatedData['lateDuration'],
            'isApproved' => '1',
            'isCurrent' => '0'
        ];

        MakeupSchedule::create($scheduleData);

        toastr()->success('Make-Up Schedule Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Edit Schedule
    public function editSchedule(int $schedule_id){
        $schedule = MakeupSchedule::find($schedule_id);
        if($schedule){
            $this->schedule_id = $schedule->id;
            $this->course_id = $schedule->course_id;
            $this->course_code = $schedule->course->course_code;
            $this->instructor_fname = $schedule->course->instructor->first_name;
            $this->instructor_lname = $schedule->course->instructor->last_name;
            $this->days = $schedule->days;
            $this->time_start = Carbon::parse($schedule->time_start)->format('H:i:s');
            $this->time_end = Carbon::parse($schedule->time_end)->format('H:i:s');
            $this->lateDuration = $schedule->lateDuration;
        } else {
            return redirect()->to('/makeupscheds');
        }
    }

    public function updateSchedule(){
        $validatedData = $this->validate();

        MakeupSchedule::where('id', $this->schedule_id)->update([
            'course_id' => $validatedData['course_id'],
            'days' => $validatedData['days'],
            'time_start' => $validatedData['time_start'],
            'time_end' => $validatedData['time_end'],
            'lateDuration' => $validatedData['lateDuration'],
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
            MakeupSchedule::find($this->schedule_id)->delete();
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
        $this->lateDuration = '';
    }

    public function render(){
        $subjects = Subject::all();
        $instructors = Instructor::all();
        $sections = Section::all();
        $courses = Course::all();
        $schedules = MakeupSchedule::where('isApproved', '1')->paginate(10);
        return view('livewire.admin.makeup-sched.index', [
            'schedules' => $schedules,
            'courses' => $courses,
            'subjects' => $subjects,
            'instructors' => $instructors,
            'sections' => $sections
        ]);
    }
}
