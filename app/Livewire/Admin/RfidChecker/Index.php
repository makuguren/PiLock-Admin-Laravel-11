<?php

namespace App\Livewire\Admin\RfidChecker;

use App\Models\Faculty;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $tag_uid, $info;

    public function checkUIDTag(){

        $checkInst = Faculty::where('tag_uid', $this->tag_uid)->first();
        $checkStud = User::where('tag_uid', $this->tag_uid)->first();

        if($checkInst){
            $this->info = $checkInst;
        } else {
            $this->info = $checkStud;
        }
    }

    public function render(){
        return view('livewire.admin.rfid-checker.index', ['info' => $this->info]);
    }
}
