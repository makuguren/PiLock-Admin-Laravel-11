<?php

namespace App\Livewire\Archive\Admin;

use Livewire\Component;
use App\Models\Archive\Faculty;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class Faculties extends Component
{
    use WithPagination;

    public function render(){
        $faculties = Faculty::paginate(10);
        return view('livewire.archive.admin.faculties', ['faculties' => $faculties]);
    }
}
