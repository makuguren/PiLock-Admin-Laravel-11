<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Faculty;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;

class Index extends Component
{
    use WithPagination;
    public $course_id, $course_code, $course_title, $section_id, $faculty_id, $course_key;
    public $program, $year, $block;

    //Validations
    protected function rules(){
        return [
            'course_code' => 'required|string',
            'course_title' => 'required|string',
            // 'section_id' => 'required|integer',
            'program' => 'required|string',
            'year' => 'required|integer',
            'block' => 'required|string',
            'faculty_id' => 'required|integer',
            'course_key' => 'required|string',
        ];
    }
    public function messages(){
        return [
            'course_code.required' => 'Please enter the course code. This field is required.',
            'course_title.required' => 'Please enter the course title. This field is required.',
            'program.required' => 'Please select a program from the list. This field is required.',
            'year.required' => 'Please select the year. This field is required.',
            'block.required' => 'Please select the block. This field is required.',
            'faculty_id.required' => 'Please select the faculty member. This field is required.',
            'course_key.required' => 'Please enter the enrollment key. This field is required.'
        ];
    }
    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    //Save Course
    public function saveCourse(){
        // dd($this->program . $this->year . $this->block);
        $validatedData = $this->validate();

        // Check if the Section is Not Exists then Create the Section before Executing
        $checkSection = Section::where('program', $this->program)->where('year', $this->year)->where('block', $this->block)->first();

        if($checkSection == NULL){
            Section::create([
                'program' => $validatedData['program'],
                'year' => $validatedData['year'],
                'block' => $validatedData['block'],
            ]);
        }

        // Find the Section and Update the StudentInfo
        $sectionId = Section::where('program', $this->program)->where('year', $this->year)->where('block', $this->block)->first();
        $this->section_id = $sectionId->id;

        Course::create([
            'course_code' => $validatedData['course_code'],
            'course_title' => $validatedData['course_title'],
            'section_id' => $this->section_id,
            'faculty_id' => $validatedData['faculty_id'],
            'course_key' => Crypt::encryptString($validatedData['course_key'])
        ]);

        toastr()->success('Course Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Edit Course
    public function editCourse(int $course_id){
        $course = Course::find($course_id);
        if($course){
            $this->course_id = $course->id;
            $this->course_code = $course->course_code;
            $this->course_title = $course->course_title;
            $this->program = $course->section->program;
            $this->year = $course->section->year;
            $this->block = $course->section->block;
            // $this->section_id = $course->section_id;
            $this->faculty_id = $course->faculty_id;
            $this->course_key = Crypt::decryptString($course->course_key);
        } else {
            return redirect()->to('/courses');
        }
    }

    public function updateCourse(){
        $validatedData = $this->validate();

        // Check if the Section is Not Exists then Create the Section before Executing
        $checkSection = Section::where('program', $this->program)->where('year', $this->year)->where('block', $this->block)->first();

        if($checkSection == NULL){
            Section::create([
                'program' => $validatedData['program'],
                'year' => $validatedData['year'],
                'block' => $validatedData['block'],
            ]);
        }

        // Find the Section and Update the StudentInfo
        $sectionId = Section::where('program', $this->program)->where('year', $this->year)->where('block', $this->block)->first();
        $this->section_id = $sectionId->id;

        Course::where('id', $this->course_id)->update([
            'course_code' => $validatedData['course_code'],
            'course_title' => $validatedData['course_title'],
            'section_id' => $this->section_id,
            'faculty_id' => $validatedData['faculty_id'],
            'course_key' => Crypt::encryptString($validatedData['course_key'])
        ]);
        toastr()->success('Course Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Delete Subject
    public function deleteCourse(int $course_id){
        $this->course_id = $course_id;
    }

    public function destroyCourse(){
        try{
            Course::find($this->course_id)->delete();
            toastr()->success('Course Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException $ex){
            toastr()->error('Unable to Delete Course!' . $ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function resetInput(){
        $this->course_code = '';
        $this->course_title = '';
        $this->section_id = '';
        $this->program = '';
        $this->year = '';
        $this->block = '';
        $this->faculty_id = '';
        $this->course_key = '';
    }

    public function render(){
        $courses = Course::paginate(10);
        $sections = Section::all();
        $faculties = Faculty::all();
        return view('livewire.admin.courses.index', [
            'courses' => $courses,
            'sections' => $sections,
            'faculties' => $faculties
        ]);
    }
}
