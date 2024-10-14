<?php

namespace App\Livewire\Admin\Students;

use App\Models\User;
use App\Models\Section;
use Livewire\Component;

class Adduid extends Component
{
    public $student, $student_id, $tag_uid, $first_name, $last_name, $section;
    public $isDisabled = true;

    //Validations
    protected function rules(){
        return [
            'tag_uid' => 'required|string|unique:users,tag_uid|unique:instructors,tag_uid',
            'student_id' => 'required'
        ];
    }

    public function messages(){
        return [

        ];
    }
    //End Validations

    public function findStudent(){
        $this->student = User::where('student_id', $this->student_id)->first();
        if($this->student){
            $this->isDisabled = false;
        }
    }

    public function updateUIDTag(){
        $validatedData = $this->validate();
        User::where('student_id', $this->student_id)->update([
            'tag_uid' => $validatedData['tag_uid']
        ]);
        toastr()->success('Tag UID Updated Successfully');
        $this->resetInput();
        return redirect()->to('admin/students/addtaguid');
    }

    public function resetInput(){
        $this->tag_uid = '';
        $this->student_id = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->section = '';
    }

    public function render(){
        $sections = Section::all();
        return view('livewire.admin.students.adduid', [
            'student' => $this->student,
            'sections' => $sections
        ]);
    }
}
