<?php

namespace App\Livewire\Admin\Subjects;

use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class Index extends Component
{
    use WithPagination;
    public $subject_code, $subject_name, $subject_id;

    //Validations
    protected function rules(){
        return [
            'subject_code' => 'required|string',
            'subject_name' => 'required|string'
        ];
    }
    public function messages(){
        return [

        ];
    }
    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    //Save Subject
    public function saveSubject(){
        $validatedData = $this->validate();

        Subject::create($validatedData);
        toastr()->success('Subject Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Edit Subject
    public function editSubject(int $subject_id){
        $subject = Subject::find($subject_id);
        if($subject){
            $this->subject_id = $subject->id;
            $this->subject_code = $subject->subject_code;
            $this->subject_name = $subject->subject_name;
        } else {
            return redirect()->to('/subjects');
        }
    }

    public function updateSubject(){
        $validatedData = $this->validate();

        Subject::where('id', $this->subject_id)->update([
            'subject_code' => $validatedData['subject_code'],
            'subject_name' => $validatedData['subject_name'],
        ]);
        toastr()->success('Subject Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Delete Subject
    public function deleteSubject(int $subject_id){
        $this->subject_id = $subject_id;
    }

    public function destroySubject(){
        try{
            Subject::find($this->subject_id)->delete();
            toastr()->success('Subject Deleted Successfully');
            $this->dispatch('close-modal');

        } catch(QueryException){
            toastr()->error('Unable to Delete Subject!');
            $this->dispatch('close-modal');
        }
    }

    public function resetInput(){
        $this->subject_code = '';
        $this->subject_name = '';
    }

    public function render(){
        $subjects = Subject::paginate(10);
        return view('livewire.admin.subjects.index', ['subjects' => $subjects]);
    }
}
