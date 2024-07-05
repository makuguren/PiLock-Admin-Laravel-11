<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\User;
use App\Models\Event;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Instructor;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class Index extends Component
{
    public function render(){
        $totalStudents = User::count();
        $totalSchedules = Schedules::count();
        $totalInstructors = Instructor::count();
        $totalSubjects = Subject::count();
        $totalSections = Section::count();
        $totalEvents = Event::count();
        $schedulesNow = Schedules::where('isCurrent', '1')->first();
        $eventsNow = Event::where('isCurrent', '1')->first();

        //Connect API from the Device
        try {
            $response = Http::get('http://10.8.0.2:4200/cputemp');
            if($response->successful()){
                $systeminfo = json_decode($response, true);
            }
        } catch (ConnectionException $e){
            $systeminfo = null;
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
            'eventsNow' => $eventsNow
        ]);
    }
}
