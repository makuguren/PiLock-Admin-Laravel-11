<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendancesController extends Controller
{


    public function index(){
        return view('instructor.attendances.index');
    }
}
