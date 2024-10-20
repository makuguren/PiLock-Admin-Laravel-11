<?php

namespace App\Livewire\Archive\Admin;

use App\Models\Archive\User;
use App\Models\Archive\Section;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class Students extends Component
{
    use WithPagination;

    public $filter_section = '', $query = '';

    public $sortField = 'last_name';
    public $sortDirection = 'asc';

    public $wirePoll = true;

    public function filter_section(){
        dd($this->filter_section);
        $this->resetPage();
    }

    public function search(){
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

    public function render(){
        $students = User::where('student_id', 'like', '%'.$this->query.'%')
                        // When the Filter section is "Selected" not empty string meaning excecute the code below. else, it will show all the users.
                        ->when($this->filter_section !== '', function($query) {
                            $query->where('section_id', $this->filter_section);
                        })
                        ->orderBy($this->sortField, $this->sortDirection) //Order BY either ASC or DESC by Clicking table
                        ->paginate(10);
        $sections = Section::all();
        return view('livewire.archive.admin.students', [
            'students' => $students,
            'sections' => $sections
        ]);
    }
}
