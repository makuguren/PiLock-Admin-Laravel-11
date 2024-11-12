<?php

namespace App\Livewire\Admin\Faculties;

use Livewire\Component;
use App\Models\Faculty;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class Index extends Component
{
    use WithPagination;
    public $first_name, $last_name, $gender, $email, $password, $faculty_id, $taguid;

    // Validations
    protected function rules(){
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|integer',
            'email' => 'required|email|max:255|unique:faculties,email',
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

    //Save Faculty
    public function saveFaculty(){
        $validatedData = $this->validate();

        Faculty::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        toastr()->success('Faculty Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Edit Faculty
    public function editFaculty(int $faculty_id){
        $faculty = Faculty::find($faculty_id);
        if($faculty){
            $this->faculty_id = $faculty->id;
            $this->first_name = $faculty->first_name;
            $this->last_name = $faculty->last_name;
            $this->gender = $faculty->gender;
            $this->email = $faculty->email;
        } else {
            return redirect()->to('/faculties');
        }
    }

    public function updateFaculty(){
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

        Faculty::where('id', $this->faculty_id)->update($data);
        toastr()->success('Faculty Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Delete Faculty
    public function deleteFaculty(int $faculty_id){
        $this->faculty_id = $faculty_id;
    }

    public function destroyFaculty(){
        try{
            Faculty::find($this->faculty_id)->delete();
            toastr()->success('Faculty Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException){
            toastr()->error('Unable to Delete Faculty!');
            $this->dispatch('close-modal');
        }
    }

    public function disableRFID(int $taguid){
        // dd($taguid);
        $this->taguid = $taguid;
    }

    public function destroyRFID(){
        Faculty::findOrFail($this->taguid)->update([
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
        $faculties = Faculty::paginate(10);
        return view('livewire.admin.faculties.index', ['faculties' => $faculties]);
    }
}
