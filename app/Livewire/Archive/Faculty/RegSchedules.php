<?php

namespace App\Livewire\Archive\Faculty;

use App\Models\Archive\Course;
use Livewire\Component;
use App\Models\Archive\Schedules;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RegSchedules extends Component
{
    use WithPagination;

    public function render(){
        $query = Course::where('faculty_id', Auth::id())
            ->with(['schedule' => function ($query) {
                $query->where('isMakeUp', '0');
            }, 'schedule']);

        $courses = $query->paginate(10);
        return view('livewire.archive.faculty.schedules', ['courses' => $courses]);
    }
}
