<?php

namespace App\Livewire\Admin\Schedules;

use Livewire\Component;
use App\Models\Schedules;

class Approvals extends Component
{
    public function render(){
        $schedules = Schedules::where('isMakeUp', '1')->where('isApproved', '0')->paginate(10);
        return view('livewire.admin.schedules.approvals', ['schedules' => $schedules]);
    }

    public function makeupApprove(int $schedule_id){
        $schedule = Schedules::findOrFail($schedule_id);
        $schedule->update([
            'isApproved' => '1'
        ]);
        toastr()->success('Make-Up Schedule Approved Successfully');
    }

    public function makeupDecline(int $schedule_id){
        $schedule = Schedules::findOrFail($schedule_id);
        $schedule->update([
            'isApproved' => '2'
        ]);
        toastr()->success('Make-Up Schedule Declined Successfully');
    }
}
