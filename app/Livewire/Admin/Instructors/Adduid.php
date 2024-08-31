<?php

namespace App\Livewire\Admin\Instructors;

use Livewire\Component;
use App\Models\Instructor;

class Adduid extends Component
{
    public $instructor, $instructor_id, $tag_uid, $instructor_name, $instructor_email;
    public $isDisabled = true;

    //Validations
    protected function rules(){
        return [
            'tag_uid' => 'required|string|unique:instructors,tag_uid|unique:users,tag_uid',
            'instructor_id' => 'required'
        ];
    }

    public function messages(){
        return [

        ];
    }
    //End Validations

    public function findInstructor(){
        $this->instructor = Instructor::where('id', $this->instructor_id)->first();
        if($this->instructor){
            $this->isDisabled = false;
        }
    }

    public function updateUIDTag(){
        $validatedData = $this->validate();
        Instructor::where('id', $this->instructor_id)->update([
            'tag_uid' => $validatedData['tag_uid']
        ]);
        toastr()->success('Tag UID Updated Successfully');
        $this->resetInput();
        return redirect()->to('admin/instructors/addtaguid');
    }

    public function resetInput(){
        $this->tag_uid = '';
        $this->instructor_id = '';
        $this->instructor_name = '';
        $this->instructor_email = '';
    }

    public function render(){
        return view('livewire.admin.instructors.adduid');
    }
}
