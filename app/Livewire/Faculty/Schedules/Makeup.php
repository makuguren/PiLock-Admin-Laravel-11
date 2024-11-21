<?php

namespace App\Livewire\Faculty\Schedules;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Faculty;
use App\Models\MakeupSchedule;
use Livewire\WithPagination;
use App\Rules\NoMakeupSchedOverlap;
use Illuminate\Support\Facades\Auth;

class Makeup extends Component
{
    use WithPagination;
    public $schedule_id, $course_id, $days, $time_start, $time_end, $lateDuration;
    public $course_code, $faculty_fname, $faculty_lname;

    //Validations
    protected function rules(){
        return [
            'course_id' => 'required|integer',
            'days' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',
            'lateDuration' => 'nullable|numeric|min:0|max:60',

            'time_end' => [
                new NoMakeupSchedOverlap($this->course_id, $this->days, $this->time_start, $this->time_end)
            ],
        ];
    }

    protected function messages(){
        return [
            'course_id.required' => 'The course is required.',
            'course_id.integer' => 'The course ID must be an integer.',
            'days.required' => 'Please select a day for the schedule.',
            'days.in' => 'The selected day is invalid. Please choose a valid day of the week.',
            'time_start.required' => 'The start time is required.',
            'time_end.required' => 'The end time is required.',
            'time_end.after' => 'The end time must be after the start time.',
            'lateDuration.numeric' => 'The late duration must be a number.',
            'lateDuration.min' => 'The late duration must be at least 0 minutes.',
            'lateDuration.max' => 'The late duration cannot exceed 60 minutes.',
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
            'lateDuration' => $validatedData['lateDuration'],
            'isApproved' => '0',
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
            $this->faculty_fname = $schedule->course->faculty->first_name;
            $this->faculty_lname = $schedule->course->faculty->last_name;
            $this->days = $schedule->days;
            $this->time_start = Carbon::parse($schedule->time_start)->format('H:i:s');
            $this->time_end = Carbon::parse($schedule->time_end)->format('H:i:s');
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
        MakeupSchedule::find($this->schedule_id)->delete();
        toastr()->success('Make-Up Schedule Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function resetInput(){
        $this->course_id = '';
        $this->course_code = '';
        $this->faculty_fname = '';
        $this->faculty_lname = '';
        $this->days = '';
        $this->time_start = '';
        $this->time_end = '';
        $this->lateDuration = '';
    }


    public function render(){
        $sections = Section::all();
        $facultyId = Auth::id();

        // Fetch Courses with Section associated with Courses of the Faculty (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($facultyId) {
            $query->where('faculty_id', $facultyId);
        })->with('section')->get();

        // NEW QUERY: Query to Fetch Schedules by Show Courses where the Faculty is Logged In and show only the course_id using pluck, then Show the MakeupSchedule wherein the course_id based on assigned Faculty paginate to 10.
        $getCourseId = Course::where('faculty_id', $facultyId)->pluck('id')->toArray();
        $makeupscheds = MakeupSchedule::whereIn('course_id', $getCourseId)
            ->paginate(10);

        return view('livewire.faculty.schedules.makeup', [
            'makeupscheds' => $makeupscheds,
            'courseSecs' => $courseSecs,
            'sections' => $sections
        ]);
    }
}
