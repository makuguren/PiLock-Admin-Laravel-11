<?php

namespace App\Livewire\Admin\Logs;

use App\Models\Log;
use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Instructor;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $filter_coursesec, $filter_instructor, $filter_date = '';

    public function filter_coursesec(){
        $this->resetPage();
    }

    public function filter_instructor(){
        $this->resetPage();
    }

    public function filter_date(){
        $this->resetPage();
    }

    public function render(){
        $logs = Log::where('date', 'like', '%'.$this->filter_date.'%')
                    ->where('course_id', 'like', '%'.$this->filter_coursesec.'%')
                    ->orderBy('time', 'DESC')
                    ->paginate(10);

        $instructors = Instructor::all();
        $courses = Course::all();
        return view('livewire.admin.logs.index', [
            'logs' => $logs,
            'courses' => $courses,
        ]);
    }
}
