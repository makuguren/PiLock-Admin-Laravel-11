<?php

namespace App\Livewire\Instructor\Attendances;

use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Attendance;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $selectedCourseSection, $selectedSubject, $selectedDate;
    public $dlpdfcourse_id, $dlpdfdate;

    public function updatedSelectedCourseSection($value){
        $this->selectedCourseSection = $value;
        // $this->selectedSubject = null;
        $this->resetPage();
    }

    public function updatedSelectedDate($value){
        $this->selectedDate = $value;
        $this->resetPage();
    }

    public function downloadPDF(){
        // Image Paths
        $ccsimageData = base64_encode(file_get_contents(public_path('assets/images/ccs.png')));
        $ccsimageBase64 = 'data:image/jpeg;base64,' . $ccsimageData;

        $cspcimageData = base64_encode(file_get_contents(public_path('assets/images/cspc.png')));
        $cspcimageBase64 = 'data:image/jpeg;base64,' . $cspcimageData;

        $instructorId = Auth::id();
        //Fetch attendance pdf based on the Instructor Selected

        // Query to Show Courses where the Instructor is based to Current Loggedin with, Fetch the Attendances of the Student(Model).
        $query = Course::where('instructor_id', $instructorId)
            // ->with('attendance.student') // Eager load relationships (Old Version)

            ->with(['attendance' => function ($query) {
                $query->where('isCurrent', '0'); //Filter attendance where isCurrent to 0
                $query->where('date', 'like', '%'.$this->selectedDate.'%'); //Filter Date
            }, 'attendance.student']) // Eager load relationships

            // Fetch Section based on Dropdown Selected
            ->when($this->dlpdfcourse_id, function ($query) {
                    $query->where('id', $this->dlpdfcourse_id);
            });

        $courses = $query->get();

        // Getting Values from the Dialog Dropdown and Retrieve into PDF.
        // dd($this->dlpdfcourse_id);

        $section_id = Course::where('id', $this->dlpdfcourse_id)->value('section_id');
        $course_code = Course::where('id', $this->dlpdfcourse_id)->value('course_code');

        $program = Section::where('id', $section_id)->value('program');
        $year = Section::where('id', $section_id)->value('year');
        $block = Section::where('id', $section_id)->value('block');

        $data = [
            'title' => 'Attendance for Todays Vidwo!',
            'date' => $this->dlpdfdate,
            'courses' => $courses,
            'course_code' => $course_code,
            'section' => $program . ' ' . $year . $block,
            'ccsheader' => $ccsimageBase64,
            'cspcheader' => $cspcimageBase64
        ];

        $pdf = PDF::loadView('livewire.instructor.attendances.attendance', $data);

        $this->resetInput();
        $this->dispatch('close-modal');

        return response()->streamDownload(function() use($pdf){
            echo $pdf->stream();
        }, 'attendance.pdf');
    }

    public function resetInput(){
        $this->dlpdfcourse_id = '';
        $this->dlpdfdate = '';
    }

    public function render(){

        $instructorId = Auth::id();

        // Fetch Courses with Section associated with Courses of the instructor (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->with('section')->get();

        // Query to Show Courses where the Instructor is based to Current Loggedin with, Fetch the Attendances of the Student(Model).
        $query = Course::where('instructor_id', $instructorId)
            // ->with('attendance.student') // Eager load relationships (Old Version)

            ->with(['attendance' => function ($query) {
                $query->where('isCurrent', '0'); //Filter attendance where isCurrent to 0
                $query->where('date', 'like', '%'.$this->selectedDate.'%'); //Filter Date
            }, 'attendance.student']) // Eager load relationships

            // Filter Attendances(Students) from Course(Course_id) based on Dropdown Selected
            ->when($this->selectedCourseSection, function ($query) {
                    $query->where('id', $this->selectedCourseSection);
            });

        $courses = $query->get();

        return view('livewire.instructor.attendances.index',[
            'courses' => $courses,
            'courseSecs' => $courseSecs
        ]);
    }
}
