<?php

namespace App\Livewire\Archive\Admin;

use App\Models\Archive\Section;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class Sections extends Component
{
    use WithPagination;
    public $program, $year, $block, $section_id;

    public function render(){
        $sections = Section::paginate(10);
        return view('livewire.archive.admin.sections', ['sections' => $sections]);
    }
}
