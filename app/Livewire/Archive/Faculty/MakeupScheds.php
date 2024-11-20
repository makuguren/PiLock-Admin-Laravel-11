<?php

namespace App\Livewire\Archive\Faculty;

use Carbon\Carbon;
use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use Livewire\Component;
use App\Models\Archive\Schedules;
use App\Models\Archive\Faculty;
use App\Models\Archive\MakeupSchedule;
use Livewire\WithPagination;
use App\Rules\NoMakeupSchedOverlap;
use Illuminate\Support\Facades\Auth;

class MakeupScheds extends Component
{
    use WithPagination;

    public function render(){
        $facultyId = Auth::id();

        // NEW QUERY: Query to Fetch Schedules by Show Courses where the Faculty is Logged In and show only the course_id using pluck, then Show the MakeupSchedule wherein the course_id based on assigned Faculty paginate to 10.
        $getCourseId = Course::where('faculty_id', $facultyId)->pluck('id')->toArray();
        $makeupscheds = MakeupSchedule::whereIn('course_id', $getCourseId)
            ->paginate(10);

        return view('livewire.archive.faculty.makeup-scheds', [
            'makeupscheds' => $makeupscheds,
        ]);
    }
}
