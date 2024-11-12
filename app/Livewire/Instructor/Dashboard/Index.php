<?php

namespace App\Livewire\Instructor\Dashboard;

use Carbon\Carbon;
use App\Models\Course;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Attendance;
use App\Models\Faculty;
use App\Models\MakeupSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Client\ConnectionException;

class Index extends Component
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

        try {
            Http::post('http://10.8.0.2:5000/unlock');
        }catch(ConnectionException $e){

        }
        toastr()->success('Mark as Present Successfully!');
    }

    public function updateInstPassword(){

        $validated = $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
        ]);

        Faculty::find(Auth::id())->update([
            'password' => Hash::make($validated['password']),
            'isDefaultPass' => '0'
        ]);

        toastr()->success('Password Updated Successfully');
        $this->dispatch('close-modal');
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

        $makeupSched = MakeupSchedule::whereIn('course_id', $getCourseId)
                ->where('isApproved', '1')
                ->where('isCurrent', '1')
                ->get();


        $totalPresent = Attendance::where('isCurrent', '1')->where('isPresent', '1')->count();
        $totalStudents = Attendance::where('isCurrent', '1')->count();

        // Check if the Instructors Using their Default Password
        $checked = 'checked';

        $data = [
            'schedules' => $schedules,
            'makeupSched' => $makeupSched,
            'totalPresent' => $totalPresent,
            'totalStudents' => $totalStudents,
            'greetMessage' => $this->greetMessage,
            'genderGreeting' => $this->genderGreeting
        ];

        if(Auth::user()->isDefaultPass === '1'){
            $data['checked'] = $checked;
        }

        return view('livewire.instructor.dashboard.index', $data);
    }
}
