<?php

namespace App\Livewire\Archive\Instructor;

use Carbon\Carbon;
use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use Livewire\Component;
use App\Models\Archive\Schedules;
use App\Models\Archive\Instructor;
use App\Models\Archive\MakeupSchedule;
use Livewire\WithPagination;
use App\Rules\NoMakeupSchedOverlap;
use Illuminate\Support\Facades\Auth;

class MakeupScheds extends Component
{
    use WithPagination;

    public function render(){
        $instructorId = Auth::id();

        // NEW QUERY: Query to Fetch Schedules by Show Courses where the Instructor is Logged In and show only the course_id using pluck, then Show the MakeupSchedule wherein the course_id based on assigned instructor paginate to 10.
        $getCourseId = Course::where('instructor_id', $instructorId)->pluck('id')->toArray();
        $makeupscheds = MakeupSchedule::whereIn('course_id', $getCourseId)
            ->paginate(10);

        return view('livewire.archive.instructor.makeup-scheds', [
            'makeupscheds' => $makeupscheds,
        ]);
    }
}
