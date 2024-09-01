<?php

namespace App\Livewire\User\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Section;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Attendance;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Index extends Component
{
    public $student_id, $section_id, $gender, $program, $year, $block, $birthdate;
    public $greetMessage, $genderGreeting;

    use WithPagination;

    //Validations
    protected function rules(){
        return [
            'student_id' => 'required|string|unique:users,student_id',
            'program' => 'required|string',
            'year' => 'required|integer',
            'block' => 'required|string',
            'gender' => 'required|integer',
            'birthdate' => 'required'
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    //Updating the Student Info
    public function updateStudentInfo(){
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

        // Update StudentInfo
        $studentInfo = User::findOrFail(Auth::user()->id);
        $studentInfo->update([
            'student_id' => $validatedData['student_id'],
            'section_id' => $this->section_id,
            'gender' => $validatedData['gender'],
            'birthdate' => $validatedData['birthdate']
        ]);

        toastr()->success('Updated Information Successfully!');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function resetInput(){
        $this->student_id = '';
        $this->section_id = '';
        $this->birthdate = '';
    }

    public function render(){
        // Fetch Current Schedule based on Student's Enrolled Course
        $getCourseId = EnrolledCourse::where('student_id', Auth::id())->pluck('course_id')->toArray();
        $schedules = Schedules::whereIn('course_id', $getCourseId)
                ->where('isApproved', '1')
                ->where('isCurrent', '1')
                ->get();

        // Greetings from the Instructors (Good Morning, Afternoon, and Evening)
        $getHour = Carbon::now()->timezone('Asia/Manila')->format('H');
        if($getHour > 0){
            $this->greetMessage = 'Good Morning';
        }
        if($getHour > 5){
            $this->greetMessage = 'Good Morning';
        }
        if($getHour > 11){
            $this->greetMessage = 'Good Afternoon';
        }
        if($getHour > 17){
            $this->greetMessage = 'Good Evening';
        }

        // Greetings from Users (Mr. and Mrs.) based on Gender.
        if(Auth::user()->gender == '1'){
            $this->genderGreeting = 'Mr.';
        }
        if(Auth::user()->gender == '2'){
            $this->genderGreeting = 'Ms.';
        }

        // Fetch Attendance based on Students
        $attendances = Attendance::where('student_id', Auth::id())
                ->where('isCurrent', '0')
                ->orderBy('date', 'ASC')
                ->paginate(5);

        // Check if the Student's Update their Details
        $sections = Section::all();
        $checked = 'checked';

        $data = [
            'sections' => $sections,
            'greetMessage' => $this->greetMessage,
            'schedules' => $schedules,
            'attendances' => $attendances,
            'genderGreeting' => $this->genderGreeting
        ];

        if(Auth::user()->student_id == NULL || Auth::user()->section_id == NULL || Auth::user()->birthdate == NULL){
            $data['checked'] = $checked;
        }

        return view('livewire.user.dashboard.index', $data);
    }
}
