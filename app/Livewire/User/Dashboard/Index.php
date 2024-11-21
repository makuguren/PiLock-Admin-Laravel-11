<?php

namespace App\Livewire\User\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Section;
use Livewire\Component;
use App\Models\Schedules;
use App\Models\Attendance;
use App\Models\EnrolledCourse;
use App\Models\MakeupSchedule;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Index extends Component
{
    public $full_name, $first_name, $last_name, $student_id, $section_id, $gender, $program, $year, $block;
    public $greetMessage, $genderGreeting;

    use WithPagination;

    //Validations
    protected function rules(){
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255|unique:users,student_id',
            'program' => 'required|string|max:255',
            'year' => 'required|integer|min:1|max:4',
            'block' => 'required|string|max:1',
            'gender' => 'required|integer|min:1|max:2',
        ];
    }

    protected function messages(){
        return [
            'first_name.required' => 'Please enter your first name as it is a required field.',
            'first_name.string' => 'First name must be a string of characters.',
            'first_name.max' => 'First name cannot exceed 255 characters in length.',
            'last_name.required' => 'Please enter your last name as it is a required field.',
            'last_name.string' => 'Last name must be a string of characters.',
            'last_name.max' => 'Last name cannot exceed 255 characters in length.',
            'student_id.required' => 'Student ID is a required field and must be entered.',
            'student_id.string' => 'Student ID must be a string of characters.',
            'student_id.max' => 'Student ID cannot exceed 255 characters in length.',
            'student_id.unique' => 'The entered Student ID already exists in the system.',
            'program.required' => 'Program is a required field and must be selected.',
            'program.string' => 'Program must be a string of characters.',
            'program.max' => 'Program cannot exceed 255 characters in length.',
            'year.required' => 'Year is a required field and must be entered.',
            'year.integer' => 'Year must be an integer value.',
            'year.min' => 'Year must be at least 1.',
            'year.max' => 'Year cannot exceed 4.',
            'block.required' => 'Block is a required field and must be selected.',
            'block.string' => 'Block must be a single character.',
            'block.max' => 'Block cannot exceed 1 character in length.',
            'gender.required' => 'Gender is a required field and must be selected.',
            'gender.integer' => 'Gender must be an integer value.',
            'gender.min' => 'Gender must be at least 1.',
            'gender.max' => 'Gender cannot exceed 2.',
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
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'student_id' => $validatedData['student_id'],
            'section_id' => $this->section_id,
            'gender' => $validatedData['gender'],
        ]);

        toastr()->success('Updated Information Successfully!');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function resetInput(){
        $this->first_name = '';
        $this->last_name = '';
        $this->student_id = '';
        $this->section_id = '';
    }

    public function render(){
        // Fetch Current Schedule based on Student's Enrolled Course
        $getCourseId = EnrolledCourse::where('student_id', Auth::id())->pluck('course_id')->toArray();
        $schedules = Schedules::whereIn('course_id', $getCourseId)
                ->where('isApproved', '1')
                ->where('isCurrent', '1')
                ->get();

        $makeupSched = MakeupSchedule::whereIn('course_id', $getCourseId)
                ->where('isApproved', '1')
                ->where('isCurrent', '1')
                ->get();

        // Greetings from the Faculties (Good Morning, Afternoon, and Evening)
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
                ->orderBy('date', 'DESC')
                ->paginate(5);

        // Fetch Student's Full Name after Connected to Google Account
        $this->full_name = Auth::user()->name;

        // Split into First Name and Last Name (Eg. Juan Dela Cruz)
        $nameParts = explode(' ', trim(Auth::user()->name));
        $this->last_name = array_pop($nameParts);
        $this->first_name = implode(' ', $nameParts);

        // Check if the Student's Update their Details
        $sections = Section::all();
        $checked = 'checked';

        $data = [
            'sections' => $sections,
            'greetMessage' => $this->greetMessage,
            'schedules' => $schedules,
            'makeupSched' => $makeupSched,
            'attendances' => $attendances,
            'genderGreeting' => $this->genderGreeting
        ];

        if(Auth::user()->student_id == NULL || Auth::user()->section_id == NULL){
            $data['checked'] = $checked;
        }

        return view('livewire.user.dashboard.index', $data);
    }
}
