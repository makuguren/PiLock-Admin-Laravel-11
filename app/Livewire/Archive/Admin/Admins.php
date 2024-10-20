<?php

namespace App\Livewire\Archive\Admin;

use App\Models\Archive\Admin;
use Livewire\Component;
use Illuminate\Database\QueryException;

class Admins extends Component
{
    public $admin_id;

    public function deleteUser(int $admin_id){
        $this->admin_id = $admin_id;
    }

    public function destroyUser(){
        try{
            Admin::findOrFail($this->admin_id)->delete();
            toastr()->success('Admin Deleted Successfully');
            $this->dispatch('close-modal');

        } catch (QueryException $ex){
            toastr()->error('Unable to Delete Admin!' . $ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function render(){
        $admins = Admin::get();
        return view('livewire.archive.admin.admins', ['admins' => $admins]);
    }
}
