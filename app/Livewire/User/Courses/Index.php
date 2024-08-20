<?php

namespace App\Livewire\User\Courses;

use App\Models\Course;
use Livewire\Component;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Index extends Component
{
    public $course_id, $course_title, $course_key, $decrypted_Coursekey;

    // Validations
    protected function rules(){
        return [
            'course_key' => 'required|string',
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    public function getCourseDetail(int $course_id){
        $course = Course::findOrFail($course_id);
        if($course){
            $this->course_id = $course->id;
            $this->course_title = $course->course_title;
            $this->decrypted_Coursekey = $course->course_key;
        } else {
            return redirect()->to('/courses');
        }
    }

    public function enrollCourse(){
        // Check if the Enrollment is Correct
        if(Crypt::decryptString($this->decrypted_Coursekey) == $this->course_key){
            EnrolledCourse::create([
                'course_id' => $this->course_id,
                'student_id' => Auth::id()
            ]);
            toastr()->success('Course Enrolled Successfully!');
            $this->dispatch('close-modal');
        } else {
            toastr()->error('Course Key is Invalid. Please Try Again.');
            $this->dispatch('invalid-Coursekey');
        }
    }

    public function render(){
        $courses = Course::all();
        $checkEnrollCourse = EnrolledCourse::where('student_id', Auth::id())->pluck('course_id')->toArray();
        return view('livewire.user.courses.index', [
            'courses' => $courses,
            'checkEnrollCourse' => $checkEnrollCourse
        ]);
    }
}
