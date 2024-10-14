<?php

namespace App\Livewire\Global\Navbar;

use Carbon\Carbon;
use Livewire\Component;

class Timedate extends Component
{
    public function render(){
        $timedate = Carbon::now('Asia/Manila')->format('h:i:s A');
        return view('livewire.global.navbar.timedate', ['timedate' => $timedate]);
    }
}
