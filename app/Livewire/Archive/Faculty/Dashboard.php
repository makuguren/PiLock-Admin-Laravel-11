<?php

namespace App\Livewire\Archive\Faculty;

use Carbon\Carbon;
use App\Models\Archive\Course;
use Livewire\Component;
use App\Models\Archive\Schedules;
use App\Models\Archive\Attendance;
use App\Models\Archive\Faculty;
use App\Models\Archive\MakeupSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Client\ConnectionException;

class Dashboard extends Component
{
    public $greetMessage, $genderGreeting;
    public $current_password, $password, $password_confirmation;

    public function markPresent(int $schedule_id){
        $regSched = Schedules::where('id', $schedule_id)->where('isCurrent', '1')->first();
        $makeupSched = MakeupSchedule::where('id', $schedule_id)->where('isCurrent', '1')->first();

        if($regSched) {
            Schedules::where('id', $schedule_id)->update([
                'isAttend' => '1'
            ]);
        } elseif ($makeupSched) {
            MakeupSchedule::where('id', $schedule_id)->update([
                'isAttend' => '1'
            ]);
        }
        toastr()->success('Mark as Present Successfully!');
    }
    public function render(){

        // Greetings from the Faculties (Good Morning, Afternoon, and Evening)
        $getHour = Carbon::now()->timezone('Asia/Manila')->format('H');
        if($getHour > 0){
            $this->greetMessage = 'Good Morning';
        }
        if($getHour > 5){
            $this->greetMessage = 'Good Morning';
        }
        if($getHour > 11){
            $this->greetMessage = 'Good Afternoon';
        }
        if($getHour > 17){
            $this->greetMessage = 'Good Evening';
        }

        // Greetings from Faculty (Mr. and Mrs.) based on Gender.
        if(Auth::user()->gender == '1'){
            $this->genderGreeting = 'Mr.';
        }
        if(Auth::user()->gender == '2'){
            $this->genderGreeting = 'Ms.';
        }

        // Fetch Current Schedules based on Faculty Logged In.
        $getCourseId = Course::where('faculty_id', Auth::id())->pluck('id')->toArray();
        $schedules = Schedules::whereIn('course_id', $getCourseId)
                ->where('isApproved', '1')
                ->where('isCurrent', '1')
                ->get();

        $makeupSched = MakeupSchedule::whereIn('course_id', $getCourseId)
                ->where('isApproved', '1')
                ->where('isCurrent', '1')
                ->get();


        $totalPresent = Attendance::where('isCurrent', '1')->where('isPresent', '1')->count();
        $totalStudents = Attendance::where('isCurrent', '1')->count();

        $data = [
            'schedules' => $schedules,
            'makeupSched' => $makeupSched,
            'totalPresent' => $totalPresent,
            'totalStudents' => $totalStudents,
            'greetMessage' => $this->greetMessage,
            'genderGreeting' => $this->genderGreeting
        ];

        return view('livewire.archive.faculty.dashboard', $data);
    }
}
