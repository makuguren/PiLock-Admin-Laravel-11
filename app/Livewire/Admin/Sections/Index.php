<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class Index extends Component
{
    use WithPagination;
    public $program, $year, $block, $section_id;

    // Validations
    protected function rules(){
        return [
            'program' => 'required',
            'year' => 'required',
            'block' => 'required'
        ];
    }

    public function messages(){
        return [
            // 'section_name.required' => 'Fill the Section Name First',
            // 'section_name.unique' => 'Section Name has already taken. Please Type Another Section.'
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    // Validations End

    // Save Sections
    public function saveSection(){
        $validatedData = $this->validate();

        Section::create($validatedData);
        toastr()->success('Section Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    // Update Sections
    public function editSection(int $section_id){
        $section = Section::find($section_id);
        if($section){
            $this->section_id = $section->id;
            $this->program = $section->program;
            $this->year = $section->year;
            $this->block = $section->block;
        } else {
            return redirect()->to('/sections');
        }
    }

    public function updateSection(){
        $validatedData = $this->validate();

        Section::where('id', $this->section_id)->update([
            'program' => $validatedData['program'],
            'year' => $validatedData['year'],
            'block' => $validatedData['block']
        ]);
        toastr()->success('Section Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Delete Sections
    public function deleteSection(int $section_id){
        $this->section_id = $section_id;
    }

    public function destroySection(){
        try{
            Section::find($this->section_id)->delete();
            toastr()->success('Section Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException $ex){
            toastr()->error('Unable to Delete Section!' . $ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function resetInput(){
        $this->program = '';
        $this->year = '';
        $this->block = '';
    }

    public function render(){
        $sections = Section::paginate(10);
        return view('livewire.admin.sections.index', ['sections' => $sections]);
    }
}
