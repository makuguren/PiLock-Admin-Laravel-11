<?php

namespace App\Livewire\Archive\Admin;

use Carbon\Carbon;
use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use Livewire\Component;
use App\Models\Archive\Schedules;
use App\Models\Archive\Instructor;
use Livewire\WithPagination;
use App\Models\Archive\MakeupSchedule;
use App\Rules\NoMakeupSchedOverlap;
use Illuminate\Database\QueryException;

class MakeupScheds extends Component
{
    use WithPagination;

    public function render(){
        $subjects = Subject::all();
        $instructors = Instructor::all();
        $sections = Section::all();
        $courses = Course::all();
        $schedules = MakeupSchedule::where('isApproved', '1')->paginate(10);
        return view('livewire.archive.admin.makeup-sched', [
            'schedules' => $schedules,
            'courses' => $courses,
            'subjects' => $subjects,
            'instructors' => $instructors,
            'sections' => $sections
        ]);
    }
}
