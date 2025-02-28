<?php

namespace App\Livewire\Faculty\Courses;

use App\Models\Course;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Index extends Component
{
    public $cpCourseKey, $course_id, $course_code, $course_title, $section_id, $course_key;

    //Validations
    protected function rules(){
        return [
            'course_code' => 'required|string',
            'course_title' => 'required|string',
            'section_id' => 'required|integer',
            'course_key' => 'required|string',
        ];
    }

    protected function messages(){
        return [
            'course_code.required' => 'Please provide a course code.',
            'course_code.string' => 'Course code must be a valid string.',
            'course_title.required' => 'Please provide a course title.',
            'course_title.string' => 'Course title must be a valid string.',
            'section_id.required' => 'Please select a section.',
            'section_id.integer' => 'Section ID must be a valid integer.',
            'course_key.required' => 'Please provide a course key.',
            'course_key.string' => 'Course key must be a valid string.',
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    // Save Courses
    public function saveCourse(){
        $validatedData = $this->validate();

        Course::create([
            'course_code' => $validatedData['course_code'],
            'course_title' => $validatedData['course_title'],
            'section_id' => $validatedData['section_id'],
            'faculty_id' => Auth::user()->id,
            'course_key' => Crypt::encryptString($validatedData['course_key'])
        ]);
        toastr()->success('Course Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    // Edit Courses
    public function editCourse(int $course_id){
        $course = Course::find($course_id);
        if($course){
            $this->course_id = $course->id;
            $this->course_code = $course->course_code;
            $this->course_title = $course->course_title;
            $this->section_id = $course->section_id;
            $this->course_key = Crypt::decryptString($course->course_key);
        } else {
            return redirect()->to('/courses');
        }
    }

    public function updateCourse(){
        $validatedData = $this->validate();

        Course::where('id', $this->course_id)->update([
            'course_code' => $validatedData['course_code'],
            'course_title' => $validatedData['course_title'],
            'section_id' => $validatedData['section_id'],
            'faculty_id' => Auth::user()->id,
            'course_key' => Crypt::encryptString($validatedData['course_key'])
        ]);
        toastr()->success('Course Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteCourse(int $course_id){
        $this->course_id = $course_id;
    }

    public function destroyCourse(){
        Course::find($this->course_id)->delete();
        toastr()->success('Course Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function resetInput(){
        $this->course_code = '';
        $this->course_title = '';
        $this->section_id = '';
        $this->course_key = '';
    }

    public function copyEnrollmentKey(String $enrollmentKey){
        $this->cpCourseKey = $enrollmentKey;
    }

    public function render(){
        $sections = Section::all();
        $courses = Course::where('faculty_id', Auth::user()->id)->get();
        return view('livewire.faculty.courses.index', [
            'sections' => $sections,
            'courses' => $courses,
            'cpCourseKey' => $this->cpCourseKey,
        ]);
    }
}
