<?php

namespace App\Livewire\User\Dashboard;

use App\Models\User;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $student_id, $section_id, $birthdate;


    //Validations
    protected function rules(){
        return [
            'student_id' => 'required|string',
            'section_id' => 'required|integer',
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

        $studentInfo = User::findOrFail(Auth::user()->id);
        $studentInfo->update([
            'student_id' => $validatedData['student_id'],
            'section_id' => $validatedData['section_id'],
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
        $sections = Section::all();
        $checked = 'checked';
        if(Auth::user()->student_id == NULL || Auth::user()->section_id == NULL || Auth::user()->birthdate == NULL){
            return view('livewire.user.dashboard.index', [
                'checked' => $checked,
                'sections' => $sections
            ]);
        } else {
            return view('livewire.user.dashboard.index', [
                'sections' => $sections
            ]);
        }
    }
}
