<?php

namespace App\Livewire\Archive\Admin;

use Carbon\Carbon;
use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use Livewire\Component;
use App\Models\Archive\Schedules;
use App\Models\Archive\Faculty;
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
    public $schedule_id, $faculty_fname, $faculty_lname;
    public $course_id, $course_code, $days, $time_start, $time_end, $lateDuration;

    public function viewSchedule(int $schedule_id){
        $this->dispatch('view_schedule_modal');

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
            return redirect()->to('/archive/admin/schedules/timetable');
        }
    }

    public function render(){
        $faculties = Faculty::all();
        $sections = Section::all();
        $courses = Course::all();
        $schedules = Schedules::all();
        return view('livewire.archive.admin.schedules-timetable', [
            'schedules' => $schedules,
            'courses' => $courses,
            'faculties' => $faculties,
            'sections' => $sections,
        ]);
    }
}
