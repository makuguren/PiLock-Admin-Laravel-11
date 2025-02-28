<?php

namespace App\Livewire\Admin\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use WithPagination;
    public $name, $permission_id;

    // Validations
    protected function rules(){
        return [
            'name' => 'required|string|unique:permissions,name',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Permission Name is required',
            'name.unique' => 'Permission Name already exists',
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    // Validations End

    //Save Permission
    public function savePermission(){
        $validatedData = $this->validate();

        Permission::create($validatedData);
        toastr()->success('Permission Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Edit Permission
    public function editPermission(int $permission_id){
        $permission = Permission::find($permission_id);
        if($permission){
            $this->permission_id = $permission->id;
            $this->name = $permission->name;
        } else {
            return redirect()->to('/admin/permissions');
        }
    }

    public function updatePermission(){
        $validatedData = $this->validate([
            'name' => 'required|string',
        ]);

        Permission::where('id', $this->permission_id)->update([
            'name' => $validatedData['name'],
        ]);
        toastr()->success('Permission Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //Delete Permission
    public function deletePermission(int $permission_id){
        $this->permission_id = $permission_id;
    }

    public function destroyPermission(){
        try{
            Permission::find($this->permission_id)->delete();
            toastr()->success('Permission Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException $ex){
            toastr()->error('Unable to Delete Permission!' . $ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function resetInput(){
        $this->name = '';
    }

    public function render(){
        $permissions = Permission::paginate(10);
        return view('livewire.admin.permissions.index', ['permissions' => $permissions]);
    }
}
