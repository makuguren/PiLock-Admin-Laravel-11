<?php

namespace App\View\Components\Archive;

use Illuminate\View\Component;
use Illuminate\View\View;

class FacultyAppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('archive.faculty.layouts.app');
    }
}
