<?php

namespace App\Livewire\Archive\Admin;

use Carbon\Carbon;
use App\Models\Archive\Log;
use App\Models\Archive\User;
use App\Models\Archive\Event;
use App\Models\Section;
use App\Models\Archive\Setting;
use App\Models\Archive\Course;
use Livewire\Component;
use App\Models\Archive\Schedules;
use App\Models\Archive\Faculty;
use App\Models\Archive\MakeupSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Client\ConnectionException;

class Dashboard extends Component
{
    public $greetMessage;
    public $programs, $programData;
    public $countRFIDData, $countEventData;
    public $genderGreeting;

    public function getStudProgCount(){
        // Count the Number of Students Registered Per Program
        $this->programs = ['BSIT', 'BSCS', 'BLIS', 'BSIS'];

        // Fetch student counts grouped by program
        $studentCounts = User::join('sections', 'users.section_id', '=', 'sections.id')
            ->select('sections.program', DB::raw('count(users.id) as total'))
            ->groupBy('sections.program')
            ->pluck('total', 'sections.program')
            ->toArray();

        // Ensure all programs are represented, even with zero students
        $this->programData = array_map(function($program) use ($studentCounts) {
            return $studentCounts[$program] ?? 0;
        }, $this->programs);
    }

    public function getStudTapRFIDPerWeekCount(){
        // Count the Students Tapped their RFID Per Week.
        $data = Log::select(DB::raw('DAYOFWEEK(created_at) as dayOfWeek'), DB::raw('COUNT(*) as count'))
            ->groupBy('dayOfWeek')
            ->get();

        // Map the data to fit the ApexCharts format
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $counts = array_fill(0, 7, 0);

        foreach ($data as $item) {
            $counts[$item->dayOfWeek - 1] = $item->count;
        }

        return [
            'labels' => $days,
            'data' => $counts
        ];
    }

    public function getEventsPerMonth(){
        $year = Carbon::now()->year;

        // Query to count logs by month for the current year
        $data = Event::select(DB::raw('MONTH(date) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Map the data to fit the ApexCharts format
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $counts = array_fill(0, 12, 0);

        foreach ($data as $item) {
            $counts[$item->month - 1] = $item->count;
        }

        return[
            'labels' => $months,
            'data' => $counts
        ];
    }

    public function mount(){
        // Call the Counting Students Per Program
        $this->getStudProgCount();

        // Call the Count of Students Tapped their RFID Per Week.
        $this->countRFIDData = $this->getStudTapRFIDPerWeekCount();

        // Call the Counting of Events Per Month
        $this->countEventData = $this->getEventsPerMonth();
    }

    public function render(){
        $totalStudents = User::count();
        $totalSchedules = Schedules::count();
        $totalFaculties = Faculty::count();
        $totalCourses = Course::count();
        $totalSections = Section::count();
        $totalEvents = Event::count();
        $eventsNow = Event::where('isCurrent', '1')->first();
        $schedulesNow = Schedules::where('isCurrent', '1')->first();
        $makeupClassNow = MakeupSchedule::where('isCurrent', '1')->first();

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

        // Greetings from Admins (Mr. and Mrs.) based on Gender.
        if(Auth::user()->gender == '1'){
            $this->genderGreeting = 'Mr.';
        }
        if(Auth::user()->gender == '2'){
            $this->genderGreeting = 'Ms.';
        }

        return view('livewire.archive.admin.dashboard', [
            'totalStudents' => $totalStudents,
            'totalSchedules' => $totalSchedules,
            'totalEvents' => $totalEvents,
            'totalFaculties' => $totalFaculties,
            'totalCourses' => $totalCourses,
            'totalSections' => $totalSections,
            'systeminfo' => $systeminfo,
            'schedulesNow' => $schedulesNow,
            'makeupClassNow' => $makeupClassNow,
            'eventsNow' => $eventsNow,
            'greetMessage' => $this->greetMessage,
            'genderGreeting' => $this->genderGreeting
        ]);
    }
}
