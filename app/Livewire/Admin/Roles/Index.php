<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controllers\Middleware;

class Index extends Component
{
    public $name, $role_id;

    //Validations
    protected function rules(){
        return [
            'name' => 'required|string|unique:roles,name',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Role Name is required',
            'name.unique' => 'Role Name already exists',
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    //Save Role
    public function saveRole(){
        $validatedData = $this->validate();

        Role::create($validatedData);
        toastr()->success('Roles Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Edit Role
    public function editRole(int $role_id){
        $role = Role::find($role_id);
        if($role){
            $this->role_id = $role->id;
            $this->name = $role->name;
        } else {
            return redirect()->to('/admin/roles');
        }
    }

    public function updateRole(){
        $validatedData = $this->validate();

        Role::where('id', $this->role_id)->update([
            'name' => $validatedData['name'],
        ]);
        toastr()->success('Role Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Delete Role
    public function deleteRole(int $role_id){
        $this->role_id = $role_id;
    }

    public function destroyRole(){
        try{
            Role::find($this->role_id)->delete();
            toastr()->success('Role Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException $ex){
            toastr()->error('Unable to Delete Role!' . $ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function resetInput(){
        $this->name = '';
    }

    public function render(){
        $roles = Role::get();
        return view('livewire.admin.roles.index', ['roles' => $roles]);
    }
}
