<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Course;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Index extends Component
{
    public $course_id, $course_code, $course_title, $section_id, $course_key;

    //Validations
    protected function rules(){
        return [
            'course_code' => 'required|string',
            'course_title' => 'required|string',
            'section_id' => 'required|integer',
            'course_key' => 'required|string',
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
            'instructor_id' => Auth::user()->id,
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
            'instructor_id' => Auth::user()->id,
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

    public function render(){
        $sections = Section::all();
        $courses = Course::where('instructor_id', Auth::user()->id)->get();
        return view('livewire.instructor.courses.index', [
            'sections' => $sections,
            'courses' => $courses
        ]);
    }
}
