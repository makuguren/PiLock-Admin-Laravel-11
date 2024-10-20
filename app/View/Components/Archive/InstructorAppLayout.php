<?php

namespace App\View\Components\Archive;

use Illuminate\View\Component;
use Illuminate\View\View;

class InstructorAppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('archive.instructor.layouts.app');
    }
}
