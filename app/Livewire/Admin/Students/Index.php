<?php

namespace App\Livewire\Admin\Students;

use App\Models\User;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class Index extends Component
{
    use WithPagination;

    public $student_id, $taguid, $filter_section, $query = '';

    public function filter_section(){
        $this->resetPage();
    }

    public function search(){
        $this->resetPage();
    }

    public function render(){
        $students = User::Where('section_id', 'like', '%'.$this->filter_section.'%')
                        ->where('student_id', 'like', '%'.$this->query.'%')
                        ->paginate(10);
        $sections = Section::all();
        return view('livewire.admin.students.index', [
            'students' => $students,
            'sections' => $sections
        ]);
    }

    public function deleteStudent(int $student_id){
        $this->student_id = $student_id;
    }

    public function destroyStudent(){
        try{
            User::findOrFail($this->student_id)->delete();
            toastr()->success('Student Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException $ex){
            toastr()->error('Unable to Delete Student!' . $ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function disableRFID(int $taguid){
        $this->taguid = $taguid;
    }

    public function destroyRFID(){
        User::findOrFail($this->taguid)->update([
            'tag_uid' => null
        ]);

        // User::where('id', $this->taguid)->update([
        //     'tag_uid' => null
        // ]);

        toastr()->success('TagUID Disabled Successfully');
        $this->dispatch('close-modal');
    }
}
