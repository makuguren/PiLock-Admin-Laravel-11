<?php

namespace App\Livewire\Instructor\Schedules;

use App\Models\Course;
use Livewire\Component;
use App\Models\Schedules;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public function markPresent(int $schedule_id){
        $markpresent = Schedules::findOrFail($schedule_id);

        Schedules::where('id', $schedule_id)->update([
            'isAttend' => '1'
        ]);
        toastr()->success('Mark as Present Successfully!');
    }

    public function render(){
        $query = Course::where('instructor_id', Auth::id())
            ->with(['schedule' => function ($query) {
                $query->where('isMakeUp', '0');
            }, 'schedule']);

        $courses = $query->paginate(10);
        return view('livewire.instructor.schedules.index', ['courses' => $courses]);
    }
}
