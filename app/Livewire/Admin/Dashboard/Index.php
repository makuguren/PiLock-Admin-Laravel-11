<?php

namespace App\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Instructor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Client\ConnectionException;

class Index extends Component
{
    public $greetMessage;

    public function render(){
        $totalStudents = User::count();
        $totalSchedules = Schedules::count();
        $totalInstructors = Instructor::count();
        $totalSubjects = Subject::count();
        $totalSections = Section::count();
        $totalEvents = Event::count();
        $schedulesNow = Schedules::where('isCurrent', '1')->first();
        $eventsNow = Event::where('isCurrent', '1')->first();

        // $setting = Setting::where('id', '1')->first();

        // Configuration if the System Integration is either on and off using Global Variable.
        $appSetting = View::shared('appSetting');

        //Connect API from the Device
        if($appSetting->isDevInteg == '0'){
            $systeminfo = null;
        } else {
            try {
                $response = Http::get('http://10.8.0.2:4200/cputemp');
                if($response->successful()){
                    $systeminfo = json_decode($response, true);
                }
            } catch (ConnectionException $e){
                $systeminfo = null;
            }
        }

        // Greetings from the Admins (Good Morning, Afternoon, and Evening)
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

        return view('livewire.admin.dashboard.index', [
            'totalStudents' => $totalStudents,
            'totalSchedules' => $totalSchedules,
            'totalEvents' => $totalEvents,
            'totalInstructors' => $totalInstructors,
            'totalSubjects' => $totalSubjects,
            'totalSections' => $totalSections,
            'systeminfo' => $systeminfo,
            'schedulesNow' => $schedulesNow,
            'eventsNow' => $eventsNow,
            'greetMessage' => $this->greetMessage
        ]);
    }
}
