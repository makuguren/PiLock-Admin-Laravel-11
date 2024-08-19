<?php

namespace App\Livewire\Admin\Instructors;

use Livewire\Component;
use App\Models\Instructor;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class Index extends Component
{
    use WithPagination;
    public $name, $gender, $email, $password, $instructor_id;

    // Validations
    protected function rules(){
        return [
            'name' => 'required|string|max:255',
            'gender' => 'required|integer',
            'email' => 'required|email|max:255|unique:instructors,email',
            'password' => 'required|string|min:8|max:20'
        ];
    }

    public function messages(){
        return [

        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    // Validations End

    //Save Instructor
    public function saveInstructor(){
        $validatedData = $this->validate();

        Instructor::create([
            'name' => $validatedData['name'],
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        toastr()->success('Instructor Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Edit Instructor
    public function editInstructor(int $instructor_id){
        $instructor = Instructor::find($instructor_id);
        if($instructor){
            $this->instructor_id = $instructor->id;
            $this->name = $instructor->name;
            $this->gender = $instructor->gender;
            $this->email = $instructor->email;
        } else {
            return redirect()->to('/instructors');
        }
    }

    public function updateInstructor(){
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|integer',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|max:20'
        ]);

        $data = [
            'name' => $validatedData['name'],
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'],
        ];

        if(!empty($validatedData['password'])){
            $data += [
                'password' => Hash::make($validatedData['password']),
            ];
        }

        Instructor::where('id', $this->instructor_id)->update($data);
        toastr()->success('Instructor Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Delete Instructor
    public function deleteInstructor(int $instructor_id){
        $this->instructor_id = $instructor_id;
    }

    public function destroyInstructor(){
        try{
            Instructor::find($this->instructor_id)->delete();
            toastr()->success('Instructor Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException){
            toastr()->error('Unable to Delete Instructor!');
            $this->dispatch('close-modal');
        }
    }

    public function resetInput(){
        $this->name = '';
        $this->gender = '';
        $this->email = '';
        $this->password = '';
    }

    public function render(){
        $instructors = Instructor::paginate(10);
        return view('livewire.admin.instructors.index', ['instructors' => $instructors]);
    }
}
