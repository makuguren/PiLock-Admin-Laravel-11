<?php

namespace App\Livewire\Admin\Logs;

use App\Models\Log;
use App\Models\User;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Instructor;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $filter_subject, $filter_section, $filter_instructor, $filter_date = '';

    public function filter_subject(){
        $this->resetPage();
    }

    public function filter_section(){
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
                    ->where('subject_id', 'like', '%'.$this->filter_subject.'%')
                    ->where('section_id', 'like', '%'.$this->filter_section.'%')
                    ->where('instructor_id', 'like', '%'.$this->filter_instructor.'%')
                    ->paginate(10);

        $students = User::all();
        $sections = Section::all();
        $instructors = Instructor::all();
        $subjects = Subject::all();
        return view('livewire.admin.logs.index', [
            'logs' => $logs,
            'students' => $students,
            'sections' => $sections,
            'instructors' => $instructors,
            'subjects' => $subjects
        ]);
    }
}
