<?php

namespace App\Livewire\Archive\Admin;

use Carbon\Carbon;
use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use Livewire\Component;
use App\Models\Archive\Schedules;
use App\Models\Archive\Attendance;
use App\Models\Archive\Instructor;
use Livewire\WithPagination;
use App\Imports\CourseImport;
use Livewire\WithFileUploads;
use App\Models\Archive\EnrolledCourse;
use App\Imports\ScheduleImport;
use App\Rules\NoScheduleOverlap;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;

class RegSchedules extends Component
{
    use WithPagination;

    public function render(){
        $subjects = Subject::all();
        $instructors = Instructor::all();
        $sections = Section::all();
        $courses = Course::all();
        $schedules = Schedules::where('isMakeUp', '0')
            ->orderBy('days', 'ASC')
            ->orderBy('time_start', 'ASC')
            ->paginate(10);
        return view('livewire.archive.admin.schedules', [
            'schedules' => $schedules,
            'courses' => $courses,
            'subjects' => $subjects,
            'instructors' => $instructors,
            'sections' => $sections,
            // 'isDisableButton' => $this->isDisableButton,
        ]);
    }
}
