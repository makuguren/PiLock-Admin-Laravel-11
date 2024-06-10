<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Schedules;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchedulesController extends Controller
{
    public function index(){
        return view('instructor.schedules.index');
    }

    public function makeupIndex(){
        return view('instructor.schedules.makeup');
    }
}
