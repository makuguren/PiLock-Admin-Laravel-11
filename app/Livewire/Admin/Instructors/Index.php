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
    public $first_name, $last_name, $gender, $email, $password, $instructor_id, $taguid;

    // Validations
    protected function rules(){
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|integer',
            'email' => 'required|email|max:255|unique:instructors,email',
            'password' => 'required|string|min:8|max:20'
        ];
    }

    public function messages(){
        return [
            'first_name.required' => "The first name is required. Please provide the faculty member's first name.",
            'last_name.required' => "The last name is required. Please provide the faculty member's last name.",
            'gender' => 'Please select a gender. This field is required.',
            'email.required' => 'A valid email address is required. Please enter a unique email for the faculty member.',
            'email.unique' => 'The email you provided is already in use. Please enter a different email address.',
            'password.required' => 'The password is required. Please enter a password.',
            'password.min' => 'The password must be between 8 and 20 characters. Ensure your password meets this requirement.'
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
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
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
            $this->first_name = $instructor->first_name;
            $this->last_name = $instructor->last_name;
            $this->gender = $instructor->gender;
            $this->email = $instructor->email;
        } else {
            return redirect()->to('/instructors');
        }
    }

    public function updateInstructor(){
        $validatedData = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|integer',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|max:20'
        ]);

        $data = [
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
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

    public function disableRFID(int $taguid){
        // dd($taguid);
        $this->taguid = $taguid;
    }

    public function destroyRFID(){
        Instructor::findOrFail($this->taguid)->update([
            'tag_uid' => null
        ]);

        // User::where('id', $this->taguid)->update([
        //     'tag_uid' => null
        // ]);

        toastr()->success('TagUID Disabled Successfully');
        $this->dispatch('close-modal');
    }

    public function resetInput(){
        $this->first_name = '';
        $this->last_name = '';
        $this->gender = '';
        $this->email = '';
        $this->password = '';
    }

    public function render(){
        $instructors = Instructor::paginate(10);
        return view('livewire.admin.instructors.index', ['instructors' => $instructors]);
    }
}
