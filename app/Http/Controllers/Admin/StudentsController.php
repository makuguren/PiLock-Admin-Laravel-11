<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Section;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\StudentFormRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class StudentsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Create Students', only: ['create', 'storeStudent']),
            new Middleware('permission:Update Students', only: ['edit', 'updateStudent']),
        ];
    }

    // Create attendance in just one click
        // $users = User::where('section_id', '1')->get(); //Sections where scheduled assigned
        // $attendanceData = [];

        // foreach ($users as $user) {
        //     $attendanceData[] = [
        //         'student_id' => $user->id
        //     ];
        // }
        // Attendance::insert($attendanceData);
        // dd("Student Attendance Created Successfully!");

    // Delete all attendance table
        // Attendance::truncate();
        // dd("Student Attendance Deleted Successfully!");

    public function create(){
        $sections = Section::all();
        return view('livewire.admin.students.create', ['sections' => $sections]);
    }

    public function storeStudent(StudentFormRequest $request){
        $validatedData = $request->validated();

        User::create([
            'student_id' => $validatedData['student_id'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'section_id' => $validatedData['section_id'],
            'gender' => $validatedData['gender'],
            'birthdate' => $validatedData['birthdate'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);
        toastr()->success('Student Created Successfully');
        return redirect()->route('admin.students.index');
    }

    public function edit(int $student_id){
        $sections = Section::all();
        $student = User::findOrFail($student_id);
        return view('livewire.admin.students.edit', [
            'sections' => $sections,
            'student' => $student
        ]);
    }

    public function updateStudent(Request $request, int $student_id){
        $validatedData = $request->validate([
            'student_id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'section_id' => 'required|integer',
            'gender' => 'required|integer',
            'birthdate' => 'required|date',
            'email' => 'required|string|email|lowercase',
        ]);

        $data = [
            'student_id' => $validatedData['student_id'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'section_id' => $validatedData['section_id'],
            'gender' => $validatedData['gender'],
            'birthdate' => $validatedData['birthdate'],
            'email' => $validatedData['email'],
        ];

        if(!empty($validatedData['password'])){
            $data += [
                'password' => Hash::make($validatedData['password']),
            ];
        }

        User::where('id', $student_id)->update($data);
        toastr()->success('Student Updated Successfully');
        return redirect()->route('admin.students.index');
    }

    //API Controllers/Functions
    public function showStudentsAPI(){
        $students = User::all();
        if($students->count() > 0){
            return response()->json([
                'students' => $students->map(function ($student) {
                    return [
                        'id' => $student->id,
                        'student_id' => $student->student_id,
                        'tag_uid' => $student->tag_uid,
                        'first_name' => $student->first_name,
                        'last_name' => $student->last_name,
                        'program' => $student->section->program ?? null,
                        'year' => $student->section->year ?? null,
                        'block' => $student->section->block ?? null,
                        'birthdate' => $student->birthdate,
                        'avatar' => $student->avatar
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Students Found'
            ], 404);
        }
    }

    public function showStudentAPI(String $student_id){
        $students = User::where('student_id', $student_id)->get();
        if($students->count() > 0){
            return response()->json([
                'student' => $students->map(function ($student) {
                    return [
                        'id' => $student->id,
                        'student_id' => $student->student_id,
                        'tag_uid' => $student->tag_uid,
                        'first_name' => $student->first_name,
                        'last_name' => $student->last_name,
                        'program' => $student->section->program ?? null,
                        'year' => $student->section->year ?? null,
                        'block' => $student->section->block ?? null,
                        'birthdate' => $student->birthdate,
                        'avatar' => $student->avatar
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Student Found'
            ], 404);
        }
    }
}
