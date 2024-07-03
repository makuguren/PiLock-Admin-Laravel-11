<?php

namespace App\Livewire\Admin\Attendances;

use Livewire\Component;
use App\Models\Attendance;

class Current extends Component
{
    public function render(){
        $attendances = Attendance::where('isCurrent', '1')->get();
        return view('livewire.admin.attendances.current', ['attendances' => $attendances]);
    }
}
