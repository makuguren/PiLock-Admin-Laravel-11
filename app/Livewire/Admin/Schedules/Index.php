<?php

namespace App\Livewire\Admin\Schedules;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Instructor;
use Livewire\WithPagination;
use App\Imports\CourseImport;
use Livewire\WithFileUploads;
use App\Imports\ScheduleImport;
use App\Rules\NoScheduleOverlap;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $schedule_id, $course_id, $days, $time_start, $time_end, $isCurrent;
    public $instructor_name, $import_file, $isDisableButton;

    //Validations
    // protected function rules(){
    //     return [
    //         'course_id' => 'required|integer',
    //         'days' => 'required|string',
    //         'time_start' => 'required',
    //         'time_end' => 'required',
    //     ];
    // }

    protected function rules(){
        return [
            'course_id' => 'required|integer',
            'days' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',

            'time_end' => [
                new NoScheduleOverlap($this->course_id, $this->days, $this->time_start, $this->time_end)
            ],
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

    // public function enableButton(){
    //     $this->isDisableButton = true;
    //     sleep(10);
    //     $this->isDisableButton = false;
    // }

    public function importSchedule(){
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
    }

    //Save Schedule
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
            'isApproved' => '1',
            'isMakeUp' => '0',
            'isCurrent' => '0',
        ];

        // Check if the Schedule Start is Beyond at the Current Time
        if($this->time_start <= $time && $this->days === $day){
            $scheduleData['isCurrent'] = '1';
        }

        Schedules::create($scheduleData);
        toastr()->success('Schedule Added Successfully');
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
            return redirect()->to('/schedules');
        }
    }

    public function updateSchedule(){
        $validatedData = $this->validate();

        Schedules::where('id', $this->schedule_id)->update([
            'course_id' => $validatedData['course_id'],
            'days' => $validatedData['days'],
            'time_start' => $validatedData['time_start'],
            'time_end' => $validatedData['time_end']
        ]);

        toastr()->success('Schedule Updated Successfully');
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
    }

    public function render(){
        $subjects = Subject::all();
        $instructors = Instructor::all();
        $sections = Section::all();
        $courses = Course::all();
        $schedules = Schedules::where('isMakeUp', '0')->paginate(10);
        return view('livewire.admin.schedules.index', [
            'schedules' => $schedules,
            'courses' => $courses,
            'subjects' => $subjects,
            'instructors' => $instructors,
            'sections' => $sections,
            'isDisableButton' => $this->isDisableButton,
        ]);
    }
}
