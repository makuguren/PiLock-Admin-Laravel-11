<?php

namespace App\Livewire\Instructor\Schedules;

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
        $schedules = Schedules::where('isMakeUp', '0')->where('instructor_id', Auth::user()->id)->paginate(10);
        return view('livewire.instructor.schedules.index', ['schedules' => $schedules]);
    }
}
