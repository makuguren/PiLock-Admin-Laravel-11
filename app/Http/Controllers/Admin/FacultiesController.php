<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacultiesController extends Controller
{
    //API Controllers/Functions
    public function showFacultiesAPI(){
        $faculties = Faculty::all();
        if($faculties->count() > 0){
            return response()->json([
                'faculties' => $faculties->map(function ($faculty) {
                    return [
                        'id' => $faculty->id,
                        'tag_uid' => $faculty->tag_uid,
                        'faculty_fname' => $faculty->first_name,
                        'faculty_lname' => $faculty->last_name,
                        'faculty_email' => $faculty->email
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Faculties Found'
            ], 404);
        }
    }

    public function showFacultyAPI(String $faculty_uid){
        $faculty = Faculty::where('tag_uid', $faculty_uid)->get();
        if($faculty->count() > 0){
            return response()->json([
                'faculty' => $faculty->map(function ($faculty) {
                    return [
                        'id' => $faculty->id,
                        'tag_uid' => $faculty->tag_uid,
                        'faculty_fname' => $faculty->first_name,
                        'faculty_lname' => $faculty->last_name,
                        'faculty_email' => $faculty->email
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Faculty UID Found'
            ], 404);
        }
    }
}
