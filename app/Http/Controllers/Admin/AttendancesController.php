<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    public function currentIndex(){
        return view('admin.attendances.current');
    }

    public function index(){
        return view('admin.attendances.index');
    }
}
