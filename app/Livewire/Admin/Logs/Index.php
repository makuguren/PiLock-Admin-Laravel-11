<?php

namespace App\Livewire\Admin\Logs;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Instructor;
use App\Exports\LogsExport;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $filter_coursesec, $filter_instructor, $filter_date = '';
    public $dlsection_id, $dlfromdate, $dltodate;

    public $sortField = 'time_in';
    public $sortDirection = 'desc';

    public $wirePoll = true;

    public function filter_coursesec(){
        $this->resetPage();
    }

    public function filter_instructor(){
        $this->resetPage();
    }

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
        return (new LogsExport($this->dlsection_id, $this->dlfromdate, $this->dltodate))->download('logsreport.xlsx');
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

        $instructors = Instructor::all();
        $courses = Course::all();
        return view('livewire.admin.logs.index', [
            'logs' => $logs,
            'courses' => $courses,
        ]);
    }
}
