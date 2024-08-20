<?php

namespace App\Livewire\Instructor\Dashboard;

use Carbon\Carbon;
use App\Models\Course;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class Index extends Component
{
    public $greetMessage, $genderGreeting;

    public function markPresent(int $schedule_id){
        $markpresent = Schedules::findOrFail($schedule_id);

        Schedules::where('id', $schedule_id)->update([
            'isAttend' => '1'
        ]);
        try {
            Http::post('http://10.8.0.2:5000/unlock');
        }catch(ConnectionException $e){

        }
        toastr()->success('Mark as Present Successfully!');
    }

    public function render(){

        // Greetings from the Instructors (Good Morning, Afternoon, and Evening)
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

        // Greetings from Instructor (Mr. and Mrs.) based on Gender.
        if(Auth::user()->gender == '1'){
            $this->genderGreeting = 'Mr.';
        }
        if(Auth::user()->gender == '2'){
            $this->genderGreeting = 'Ms.';
        }

        // Fetch Current Schedules based on Instructor Logged In.
        $getCourseId = Course::where('instructor_id', Auth::id())->pluck('id')->toArray();
        $schedules = Schedules::whereIn('course_id', $getCourseId)
                ->where('isApproved', '1')
                ->where('isCurrent', '1')
                ->get();


        $totalPresent = Attendance::where('isCurrent', '1')->where('isPresent', '1')->count();
        $totalStudents = Attendance::where('isCurrent', '1')->count();
        return view('livewire.instructor.dashboard.index',[
            // 'courses' => $courses,
            'schedules' => $schedules,
            'totalPresent' => $totalPresent,
            'totalStudents' => $totalStudents,
            'greetMessage' => $this->greetMessage,
            'genderGreeting' => $this->genderGreeting
        ]);
    }
}
