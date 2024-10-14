<?php

namespace App\Livewire\Admin\Attendances;

use Livewire\Component;
use App\Models\Attendance;

class Index extends Component
{
    public function render(){
        $attendances = Attendance::where('isCurrent', '0')->get();
        return view('livewire.admin.attendances.index', ['attendances' => $attendances]);
    }
}
