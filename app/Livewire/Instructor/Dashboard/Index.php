<?php

namespace App\Livewire\Instructor\Dashboard;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $greetMessage;

    public function markPresent(int $schedule_id){
        $markpresent = Schedules::findOrFail($schedule_id);

        Schedules::where('id', $schedule_id)->update([
            'isAttend' => '1'
        ]);
        toastr()->success('Mark as Present Successfully!');
    }

    public function render(){

        // Greetings from the Admins (Good Morning, Afternoon, and Evening)
        $getHour = Carbon::now()->timezone('Asia/Manila')->format('H');
        if($getHour > 0){
            $this->greetMessage = 'Good Morning';
        }
        if($getHour > 6){
            $this->greetMessage = 'Good Morning';
        }
        if($getHour > 12){
            $this->greetMessage = 'Good Afternoon';
        }
        if($getHour > 18){
            $this->greetMessage = 'Good Evening';
        }

        $curschedule = Schedules::where('instructor_id', Auth::user()->id)
                                ->where('isApproved', '1')
                                ->where('isCurrent', '1')
                                ->first();
        $totalPresent = Attendance::where('isCurrent', '1')->where('isPresent', '1')->count();
        $totalStudents = Attendance::where('isCurrent', '1')->count();
        return view('livewire.instructor.dashboard.index',[
            'curschedule' => $curschedule,
            'totalPresent' => $totalPresent,
            'totalStudents' => $totalStudents,
            'greetMessage' => $this->greetMessage
        ]);
    }
}
