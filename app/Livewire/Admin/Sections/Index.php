<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $section_name, $section_id;

    // Validations
    protected function rules(){
        return [
            'section_name' => 'required|string|max:7|starts_with:BSIT,BSCS,BLIS,BSIS'
        ];
    }

    public function messages(){
        return [
            'section_name.required' => 'Fill the Section Name First',
            'section_name.unique' => 'Section Name has already taken. Please Type Another Section.'
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
            $this->section_name = $section->section_name;
        } else {
            return redirect()->to('/sections');
        }
    }

    public function updateSection(){
        $validatedData = $this->validate();

        Section::where('id', $this->section_id)->update([
            'section_name' => $validatedData['section_name']
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
        Section::find($this->section_id)->delete();
        toastr()->success('Section Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function resetInput(){
        $this->section_name = '';
    }

    public function render(){
        $sections = Section::paginate(10);
        return view('livewire.admin.sections.index', ['sections' => $sections]);
    }
}
