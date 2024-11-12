<?php

namespace App\Livewire\Admin\Faculties;

use Livewire\Component;
use App\Models\Faculty;

class Adduid extends Component
{
    public $faculty, $faculty_id, $tag_uid, $faculty_name, $faculty_email;
    public $isDisabled = true;

    //Validations
    protected function rules(){
        return [
            'tag_uid' => 'required|string|unique:faculties,tag_uid|unique:users,tag_uid',
            'faculty_id' => 'required'
        ];
    }

    public function messages(){
        return [

        ];
    }
    //End Validations

    public function findFaculty(){
        $this->faculty = Faculty::where('id', $this->faculty_id)->first();
        if($this->faculty){
            $this->isDisabled = false;
        }
    }

    public function updateUIDTag(){
        $validatedData = $this->validate();
        Faculty::where('id', $this->faculty_id)->update([
            'tag_uid' => $validatedData['tag_uid']
        ]);
        toastr()->success('Tag UID Updated Successfully');
        $this->resetInput();
        return redirect()->to('admin/faculties/addtaguid');
    }

    public function resetInput(){
        $this->tag_uid = '';
        $this->faculty_id = '';
        $this->faculty_name = '';
        $this->faculty_email = '';
    }

    public function render(){
        return view('livewire.admin.faculties.adduid');
    }
}
