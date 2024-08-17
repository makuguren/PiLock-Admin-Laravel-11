<?php

namespace App\Livewire\Admin\Analytics;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $programs, $programData;
    public $countRFIDData, $countEventData;

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
        return view('livewire.admin.analytics.index');
    }
}
