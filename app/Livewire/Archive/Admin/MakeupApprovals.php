<?php

namespace App\Livewire\Archive\Admin;

use App\Models\Archive\MakeupSchedule;
use Livewire\Component;
use App\Models\Archive\Schedules;

class MakeupApprovals extends Component
{
    public function render(){
        $schedules = MakeupSchedule::where('isApproved', '0')->paginate(10);
        return view('livewire.archive.admin.schedules-approvals', ['schedules' => $schedules]);
    }

    public function makeupApprove(int $schedule_id){
        $schedule = MakeupSchedule::findOrFail($schedule_id);
        $schedule->update([
            'isApproved' => '1'
        ]);
        toastr()->success('Make-Up Schedule Approved Successfully');
    }

    public function makeupDecline(int $schedule_id){
        $schedule = MakeupSchedule::findOrFail($schedule_id);
        $schedule->update([
            'isApproved' => '2'
        ]);
        toastr()->success('Make-Up Schedule Declined Successfully');
    }
}
