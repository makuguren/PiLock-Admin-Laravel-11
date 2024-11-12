<?php

namespace App\Livewire\Admin\RfidChecker;

use App\Models\Faculty;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $tag_uid, $info;

    public function checkUIDTag(){

        $checkFaculty = Faculty::where('tag_uid', $this->tag_uid)->first();
        $checkStud = User::where('tag_uid', $this->tag_uid)->first();

        if($checkFaculty){
            $this->info = $checkFaculty;
        } else {
            $this->info = $checkStud;
        }
    }

    public function render(){
        return view('livewire.admin.rfid-checker.index', ['info' => $this->info]);
    }
}
