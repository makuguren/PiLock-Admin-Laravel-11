<?php

namespace App\Livewire\Instructor\Attendances;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Attendance;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Current extends Component
{
    use WithPagination;

    public $selectedCourseSection, $selectedSubject, $selectedDate;
    public $search_student, $student_id, $first_name, $last_name, $section, $course_id;
    public $totalStudents, $countPresent, $countAbsent;

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

    public function findStudent(){
        $student = User::where('student_id', $this->search_student)->first();
        if($student){
            $this->student_id = $student->id;
            $this->first_name = $student->first_name;
            $this->last_name = $student->last_name;
            $this->section = $student->section->program . ' ' . $student->section->year . $student->section->block;
        } else {
            toastr()->error("Can't Find Student!");
        }
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

    public function addStudAttendance(){
        $datetime = Carbon::now('Asia/Manila');
        $schedule = Schedules::where('isCurrent', '1')->first();

        // Custom validation rule
        $validatedData = $this->validate([
            'course_id' => 'required|integer',
            'student_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (Attendance::where('student_id', $value)
                        ->where('course_id', $this->course_id)
                        ->exists()) {
                        $fail('This Student has been already added into attendances.');
                    }
                },
            ],
        ]);

        Attendance::create([
            'student_id' => $validatedData['student_id'],
            'course_id' => $validatedData['course_id'],
            'date' => $datetime->toDateString(),
            'time_end' => $schedule->time_end,
            'isCurrent' => '1'
        ]);

        toastr()->success("Student Student Added Successfully!");
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function resetInput(){
        $this->search_student = '';
        $this->course_id = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->section = '';
    }

    public function render(){

        // Count as Number of Present and Absent
        $this->totalStudents = Attendance::where('isCurrent', '1')->count();
        $this->countPresent = Attendance::where('isCurrent', '1')->where('isPresent', '1')->count();
        $this->countAbsent = Attendance::where('isCurrent', '1')->where('isPresent', '0')->count();

        $instructorId = Auth::id();

        // Fetch Courses with Section associated with Courses of the instructor (Dropdown Tag)
        $courseSecs = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->with('section')->get();

        // START QUERY TO FETCH STUDENTS SORT BY LAST NAME IN ASC ORDER
        $getCourseId = Course::whereHas('section', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->pluck('id')->toArray();

        $attendances = Attendance::whereIn('attendances.course_id', $getCourseId)
            ->where('attendances.isCurrent', '1')
            ->join('users', 'attendances.student_id', '=', 'users.id') // Join users table on attendances table (student_id) = users table (id)
            ->leftJoin('seat_plan', function ($join) {
                $join->on('attendances.student_id', '=', 'seat_plan.student_id')
                    ->on('attendances.course_id', '=', 'seat_plan.course_id');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->select('attendances.*', 'seat_plan.seat_number') // Select attendances table
            ->get();
        // END QUERY TO FETCH STUDENTS SORT BY LAST NAME IN ASC ORDER

        return view('livewire.instructor.attendances.current',[
            'attendances' => $attendances,
            'courseSecs' => $courseSecs
        ]);
    }
}
