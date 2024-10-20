<?php

namespace App\Livewire\Archive\Admin;

use Livewire\Component;
use App\Models\Archive\Instructor;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class Faculties extends Component
{
    use WithPagination;

    public function render(){
        $instructors = Instructor::paginate(10);
        return view('livewire.archive.admin.faculties', ['instructors' => $instructors]);
    }
}
