<?php

namespace App\Livewire\Admin\RfidChecker;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $tag_uid, $info;

    public function checkUIDTag(){
        $this->info = User::where('tag_uid', $this->tag_uid)->first();
    }

    public function render(){
        return view('livewire.admin.rfid-checker.index', ['info' => $this->info]);
    }
}
