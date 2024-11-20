<?php

namespace App\Livewire\Archive\Admin;

use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use Livewire\Component;
use App\Models\Archive\Faculty;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;

class Courses extends Component
{
    use WithPagination;

    public function render(){
        $courses = Course::paginate(10);
        $sections = Section::all();
        $faculties = Faculty::all();
        return view('livewire.archive.admin.courses', [
            'courses' => $courses,
            'sections' => $sections,
            'faculties' => $faculties
        ]);
    }
}
