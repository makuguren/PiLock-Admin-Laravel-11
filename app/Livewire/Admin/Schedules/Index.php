<?php

namespace App\Livewire\Admin\Schedules;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Attendance;
use App\Models\Faculty;
use Livewire\WithPagination;
use App\Imports\CourseImport;
use Livewire\WithFileUploads;
use App\Models\EnrolledCourse;
use App\Imports\ScheduleImport;
use App\Rules\NoScheduleOverlap;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $schedule_id, $course_id, $days, $time_start, $time_end, $lateDuration, $isCurrent;
    public $faculty_fname, $faculty_lname, $course_code, $import_file, $isDisableButton;

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
            'lateDuration' => 'nullable|numeric|min:0|max:60',

            'time_end' => [
                new NoScheduleOverlap($this->course_id, $this->days, $this->time_start, $this->time_end)
            ],
        ];
    }

    public function messages(){
        return [
            'course_id.required' => 'Kindly select a course with section.',
            'days.required' => 'At least one day must be selected.',
            'time_start.required' => 'A start time must be specified.',
            'time_end.required' => 'An end time must be specified.'
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
            $this->course_code = $fetchCourse->course_code;
            // $this->dispatch('instdetails', 'HelloWorld');
        }
    }

    // public function enableButton(){
    //     $this->isDisableButton = true;
    //     sleep(10);
    //     $this->isDisableButton = false;
    // }

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

    public function activateSched($schedule_id){
        $schedule = Schedules::findOrFail($schedule_id);

        if($schedule){
            $enrolledCourses = EnrolledCourse::where('course_id', $schedule->course_id)->get();
            $attendanceData = [];

            foreach ($enrolledCourses as $enrolledCourse) {
                $attendanceData[] = [
                    'student_id' => $enrolledCourse->student_id,
                    'course_id' => $enrolledCourse->course_id,
                    'date' => Carbon::now('Asia/Manila')->toDateString(),
                    'time_end' => $schedule->time_end,
                    'isCurrent' => '1',
                    'isMakeUp' => '0'
                ];
            }
            DB::table('attendances')->insert($attendanceData);

            $schedule->update([
                'isCurrent' => '1'
            ]);
            toastr()->success('Schedule Activated Successfully!');
        }
    }

    public function deactivateSched($schedule_id){
        $schedule = Schedules::findOrFail($schedule_id);

        if($schedule){
            $attendances = Attendance::where('time_end', $schedule->time_end)->where('isCurrent', '1')->where('isMakeUp','0')->get();
            $attendanceData = [];

            foreach ($attendances as $attendance) {
                $attendanceData[] = [
                    'student_id' => $attendance->student_id,
                    'isCurrent' => '0'
                ];
            }

            foreach ($attendanceData as $data) {
                Attendance::where('student_id', $data['student_id'])->update([
                    'isCurrent' => $data['isCurrent']
                ]);
            }
        }

        $schedule->update([
            'isCurrent' => '0',
            'isAttend' => '0'
        ]);
        toastr()->success('Schedule Deactivated Successfully!');
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

    //Edit Schedule
    public function editSchedule(int $schedule_id){
        $schedule = Schedules::find($schedule_id);
        if($schedule){
            $this->schedule_id = $schedule->id;
            $this->course_id = $schedule->course_id;
            $this->course_code = $schedule->course->course_code;
            $this->faculty_fname = $schedule->course->faculty->first_name;
            $this->faculty_lname = $schedule->course->faculty->last_name;
            $this->days = $schedule->days;
            $this->time_start = Carbon::parse($schedule->time_start)->format('H:i:s');
            $this->time_end = Carbon::parse($schedule->time_end)->format('H:i:s');
            $this->lateDuration = $schedule->lateDuration;
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
            'time_end' => $validatedData['time_end'],
            'lateDuration' => $validatedData['lateDuration'],
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
        $this->lateDuration = '';
    }

    public function render(){
        // $faculties = Faculty::all();
        $sections = Section::all();
        $courses = Course::all();
        $schedules = Schedules::where('isMakeUp', '0')
            ->orderBy('days', 'ASC')
            ->orderBy('time_start', 'ASC')
            ->paginate(10);
        return view('livewire.admin.schedules.index', [
            'schedules' => $schedules,
            'courses' => $courses,
            // 'faculties' => $faculties,
            'sections' => $sections,
            // 'isDisableButton' => $this->isDisableButton,
        ]);
    }
}
