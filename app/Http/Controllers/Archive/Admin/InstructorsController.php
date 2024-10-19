<?php

namespace App\Http\Controllers\Archive\Admin;

use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstructorsController extends Controller
{
    //API Controllers/Functions
    public function showInstructorsAPI(){
        $instructors = Instructor::all();
        if($instructors->count() > 0){
            return response()->json([
                'instructors' => $instructors->map(function ($instructor) {
                    return [
                        'id' => $instructor->id,
                        'tag_uid' => $instructor->tag_uid,
                        'instructor_name' => $instructor->name,
                        'instructor_email' => $instructor->email
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Instructor Found'
            ], 404);
        }
    }

    public function showInstructorAPI(String $instructor_uid){
        $instructor = Instructor::where('tag_uid', $instructor_uid)->get();
        if($instructor->count() > 0){
            return response()->json([
                'instructor' => $instructor->map(function ($inst) {
                    return [
                        'id' => $inst->id,
                        'tag_uid' => $inst->tag_uid,
                        'instructor_name' => $inst->name,
                        'instructor_email' => $inst->email
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Instructor UID Found'
            ], 404);
        }
    }
}
