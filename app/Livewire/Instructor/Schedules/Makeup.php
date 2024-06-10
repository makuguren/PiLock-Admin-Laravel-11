<?php

namespace App\Livewire\Instructor\Schedules;

use Livewire\Component;
use App\Models\Schedules;
use Livewire\WithPagination;

class Makeup extends Component
{
    use WithPagination;

    public function render(){
        $schedules = Schedules::where('isMakeUp', '1')->paginate(10);
        return view('livewire.instructor.schedules.makeup', ['schedules' => $schedules]);
    }
}
