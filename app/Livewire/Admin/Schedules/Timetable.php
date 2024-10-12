<?php

namespace App\Livewire\Admin\Schedules;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Instructor;
use Livewire\Attributes\On;
use App\Imports\CourseImport;
use Livewire\WithFileUploads;
use App\Imports\ScheduleImport;
use App\Rules\NoScheduleOverlap;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;

class Timetable extends Component
{
    public $schedule_id, $instructor_fname, $instructor_lname, $import_file;
    public $course_id, $course_code, $days, $time_start, $time_end, $lateDuration;

    use WithFileUploads;

    // Validations
    protected function rules(){
        return [
            'course_id' => 'required|integer',
            'days' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',
            'lateDuration' => 'nullable|numeric|min:0|max:60',

            'time_end' => [
                new NoScheduleOverlap($this->course_id, $this->days, $this->time_start, $this->time_end)
            ],
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    // Validations End

    public function importSchedule(){
        try {
            // Store the file in a specific path inside 'imports' folder
            $path = $this->import_file->storeAs('imports', 'schedules.csv', 'public');

            // Get the full path using the correct disk
            $fullPath = storage_path('app/public/' . $path);

            // Perform the import using the full path
            Excel::import(new CourseImport, $fullPath);
            Excel::import(new ScheduleImport, $fullPath);

            // Optionally delete the file after import
            Storage::disk('public')->delete($path);

            toastr()->success('Schedules Imported Successfully');
            $this->dispatch('close-modal');
        } catch (ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $this->addError('import_error', implode(', ', $failure->errors()));
            }
        }
    }

    public function fetchCourseDetails($course_id){
        $fetchCourse = Course::find($course_id);
        if($fetchCourse){
            $this->course_code = $fetchCourse->course_code;
            $this->instructor_fname = $fetchCourse->instructor->first_name;
            $this->instructor_lname = $fetchCourse->instructor->last_name;
        }
    }

    // Save Schedule
    public function saveSchedule(){
        $validatedData = $this->validate();

        //Check if the Schedule is Beyond
        $datetime = Carbon::now('Asia/Manila');
        $day = $datetime->format('l');
        $time = $datetime->toTimeString();
        $date = $datetime->toDateString();

        // Create ScheduleData
        $scheduleData = [
            'course_id' => $validatedData['course_id'],
            'days' => $validatedData['days'],
            'time_start' => $validatedData['time_start'],
            'time_end' => $validatedData['time_end'],
            'lateDuration' => $validatedData['lateDuration'],
            'isApproved' => '1',
            'isMakeUp' => '0',
            'isCurrent' => '0',
        ];

        // Check if the Schedule Start is Beyond at the Current Time
        // if($this->time_start <= $time && $this->days === $day){
        //     $scheduleData['isCurrent'] = '1';
        // }

        Schedules::create($scheduleData);
        toastr()->success('Schedule Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function viewSchedule(int $schedule_id){
        $this->dispatch('view_schedule_modal');

        $schedule = Schedules::find($schedule_id);
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
            return redirect()->to('/schedules/timetable');
        }
    }

    public function updateSchedule(){
        $validatedData = $this->validate();

        Schedules::where('id', $this->schedule_id)->update([
            'course_id' => $validatedData['course_id'],
            'days' => $validatedData['days'],
            'time_start' => $validatedData['time_start'],
            'time_end' => $validatedData['time_end'],
            'lateDuration' => $validatedData['lateDuration'],
        ]);

        toastr()->success('Schedule Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function destroySchedule(){
        try{
            Schedules::find($this->schedule_id)->delete();
            toastr()->success('Schedule Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException $ex){
            toastr()->error('Unable to Delete Schedule!' . $ex->getMessage());
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
        $schedules = Schedules::all();
        return view('livewire.admin.schedules.timetable', [
            'schedules' => $schedules,
            'courses' => $courses,
            'subjects' => $subjects,
            'instructors' => $instructors,
            'sections' => $sections,
        ]);
    }
}
