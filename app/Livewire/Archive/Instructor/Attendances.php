<?php

namespace App\Livewire\Archive\Instructor;

use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use Livewire\Component;
use App\Models\Archive\SeatPlan;
use App\Models\Archive\Schedules;
use App\Models\Archive\Attendance;
use App\Models\Archive\User;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class Attendances extends Component
{
    use WithPagination;

    public $selectedCourseSection = '', $selectedSubject = '', $selectedDate = '';
    public $dlpdfcourse_id, $dlpdfdate;

    public $sortField = 'users.last_name';
    public $sortDirection = 'asc';

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

        // START QUERY TO FETCH STUDENTS SORT BY LAST NAME IN ASC ORDER
        // Query to Show Courses where the Instructor is based to Current Loggedin with, Fetch the Attendances of the Student(Model).
        $query = Course::where('instructor_id', $instructorId)
            // ->with('attendance.student') // Eager load relationships (Old Version)

            ->with(['attendance' => function ($query) {
                $query->where('isCurrent', '0'); //Filter attendance where isCurrent to 0
                $query->where('date', 'like', '%'.$this->selectedDate.'%') //Filter Date
                ->with('student');
            }])

            // Fetch Section based on Dropdown Selected
            ->when($this->dlpdfcourse_id, function ($query) {
                $query->where('id', $this->dlpdfcourse_id);
            });

        $courses = $query->get();

        // Sort by Studen's Last Name (sortBy = Ascending Order, sortByDesc = Descending Order)
        $courses->each(function ($course) {
            $course->attendance = $course->attendance->sortBy(function ($attendance) {
                return $attendance->student->last_name; // Return student's last name
            });
        });
        // END QUERY TO FETCH STUDENTS SORT BY LAST NAME IN ASC ORDER

        // Getting Values from the Dialog Dropdown and Retrieve into PDF.
        // dd($this->dlpdfcourse_id);

        $section_id = Course::where('id', $this->dlpdfcourse_id)->value('section_id');
        $course_code = Course::where('id', $this->dlpdfcourse_id)->value('course_code');

        $program = Section::where('id', $section_id)->value('program');
        $year = Section::where('id', $section_id)->value('year');
        $block = Section::where('id', $section_id)->value('block');

        // Prepare for Fetching Seat Number by Matching Student_id and Course_id
        foreach ($courses as $course) {
            foreach ($course->attendance as $attendance) {
                // Fetch Seat Number by Matching Student_id and Course_id
                $seatPlan = SeatPlan::where('student_id', $attendance->student->id)
                    ->where('course_id', $attendance->course_id)
                    ->first();

                // Attach seat number to the attendance object
                $attendance->seat_number = $seatPlan ? $seatPlan->seat_number : 'N/A';
            }
        }

        $data = [
            'title' => 'Attendance for Todays Vidwo!',
            'date' => $this->dlpdfdate,
            'courses' => $courses,
            'course_code' => $course_code,
            'section' => $program . ' ' . $year . $block,
            'ccsheader' => $ccsimageBase64,
            'cspcheader' => $cspcimageBase64
        ];

        $pdf = Pdf::loadView('livewire.archive.instructor.attendances-template', $data);

        $this->resetInput();
        $this->dispatch('close-modal');

        return response()->streamDownload(function() use($pdf){
            echo $pdf->stream();
        }, 'attendance.pdf');
    }

    // Dynamic Table for Sorting
    public function sortBy($field){
        if($this->sortField  === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
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

        // Fetch Course IDs of the instructor based on Course-Section relationship
        $getCourseId = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->pluck('id')->toArray();

        // Fetch attendances for the logged-in instructor
        $attendances = Attendance::whereIn('attendances.course_id', $getCourseId)
            ->where('attendances.isCurrent', '0')
            // Join with users table to get student information
            ->join('users', 'attendances.student_id', '=', 'users.id')
            // Left join with seat_plan table to get seat information
            ->leftJoin('seat_plan', function ($join) {
                $join->on('attendances.student_id', '=', 'seat_plan.student_id')
                    ->on('attendances.course_id', '=', 'seat_plan.course_id');
            })
            // Select required fields
            ->select('attendances.*', 'users.last_name', 'seat_plan.seat_number', 'seat_plan.course_id')
            // Sort by student's last name in ascending order
            ->orderBy($this->sortField, $this->sortDirection)
            // Filter by selected date if provided
            ->when($this->selectedDate !== '', function ($query) {
                $query->where('attendances.date', $this->selectedDate);
            })
            // Filter by selected course section if provided
            ->when($this->selectedCourseSection !== '', function ($query) {
                $query->where('attendances.course_id', $this->selectedCourseSection);
            })
            // Paginate results
            ->paginate(10);

        return view('livewire.archive.instructor.attendances',[
            'attendances' => $attendances,
            'courseSecs' => $courseSecs
        ]);
    }
}
