<?php

namespace App\Livewire\Admin\Logs;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\FacultyLog;
use App\Models\Faculty;
use Livewire\WithPagination;
use App\Exports\StudentLogsExport;
use App\Exports\InstructorLogsExport;
use App\Exports\LogsMultiSheetExport;

class Index extends Component
{
    use WithPagination;

    public $filter_coursesec, $filter_faculty, $filter_date = '';
    public $dlsection_id, $dlfromdate, $dltodate;

    public $sortField = 'time_in';
    public $sortDirection = 'desc';

    public $wirePoll = true;

    public function filter_coursesec(){
        $this->resetPage();
    }

    // public function filter_faculty(){
    //     $this->resetPage();
    // }

    public function filter_date(){
        $this->resetPage();
    }

    // Dynamic Table for Sorting
    public function sortBy($field){
        if($this->sortField  === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function getWirePollSwitch(bool $wirePoll){
        sleep(2);
        $this->wirePoll = $wirePoll;
    }

    public function downloadLogs(){
        $this->dispatch('close-modal');
        // return (new LogsMultiSheetExport($this->dlsection_id, $this->dlfromdate, $this->dltodate))->download('logsreport.xlsx');
        $course_ids = is_array($this->dlsection_id) ? $this->dlsection_id : explode(',', $this->dlsection_id);
        return (new LogsMultiSheetExport($course_ids, $this->dlfromdate, $this->dltodate))
            ->download('logsreport.xlsx');
    }

    // Auto Selected Filter Date based on Current Days
    public function mount(){
        $this->filter_date = Carbon::now('Asia/Manila')->toDateString();
    }

    public function render(){
        $logs = Log::where('date', 'like', '%'.$this->filter_date.'%')
                    ->where('course_id', 'like', '%'.$this->filter_coursesec.'%')
                    // ->orderBy('time_in', 'DESC')
                    ->orderBy($this->sortField, $this->sortDirection) //Order BY either ASC or DESC by Clicking table
                    ->paginate(10);

        $facultyLogs = FacultyLog::where('date', 'like', '%'.$this->filter_date.'%')
                    ->where('course_id', 'like', '%'.$this->filter_coursesec.'%')
                    ->orderBy('time_in', 'DESC')
                    ->paginate(5);

        $faculties = Faculty::all();
        $courses = Course::all();
        return view('livewire.admin.logs.index', [
            'logs' => $logs,
            'facultyLogs' => $facultyLogs,
            'courses' => $courses,
        ]);
    }
}
