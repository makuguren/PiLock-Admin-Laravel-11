<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Section;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\StudentFormRequest;

class StudentsController extends Controller
{
    public function index(){
        return view('admin.students.index');
    }

    public function indextaguid(){

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

        return view('admin.students.adduid');
    }

    public function create(){
        $sections = Section::all();
        return view('admin.students.create', ['sections' => $sections]);
    }

    public function storeStudent(StudentFormRequest $request){
        $validatedData = $request->validated();

        User::create([
            'student_id' => $validatedData['student_id'],
            'name' => $validatedData['name'],
            'birthdate' => $validatedData['birthdate'],
            'section_id' => $validatedData['section_id'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);
        toastr()->success('Student Created Successfully');
        return redirect()->route('admin.students.index');
    }

    public function edit(int $student_id){
        $sections = Section::all();
        $student = User::findOrFail($student_id);
        return view('admin.students.edit', [
            'sections' => $sections,
            'student' => $student
        ]);
    }

    public function updateStudent(Request $request, int $student_id){
        $validatedData = $request->validate([
            'student_id' => 'required|string',
            'name' => 'required|string',
            'birthdate' => 'required|date',
            'section_id' => 'required|integer',
            'email' => 'required|string|email|lowercase',
        ]);

        $data = [
            'student_id' => $validatedData['student_id'],
            'name' => $validatedData['name'],
            'birthdate' => $validatedData['birthdate'],
            'section_id' => $validatedData['section_id'],
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
}
