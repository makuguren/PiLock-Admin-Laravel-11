<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorsController extends Controller
{
    public function index(){
        return view('admin.instructors.index');
    }

    public function indextaguid(){
        return view('admin.instructors.adduid');
    }
}
