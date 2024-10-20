<?php

namespace App\Livewire\Archive\Admin;

use App\Models\Archive\Instructor;
use App\Models\Archive\User;
use Livewire\Component;

class RfidChecker extends Component
{
    public $tag_uid, $info;

    public function checkUIDTag(){

        $checkInst = Instructor::where('tag_uid', $this->tag_uid)->first();
        $checkStud = User::where('tag_uid', $this->tag_uid)->first();

        if($checkInst){
            $this->info = $checkInst;
        } else {
            $this->info = $checkStud;
        }
    }

    public function render(){
        return view('livewire.archive.admin.rfid-checker', ['info' => $this->info]);
    }
}
