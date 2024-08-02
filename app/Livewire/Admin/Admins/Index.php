<?php

namespace App\Livewire\Admin\Admins;

use App\Models\Admin;
use Livewire\Component;

class Index extends Component
{
    public $admin_id;

    public function deleteUser(int $admin_id){
        $this->admin_id = $admin_id;
    }

    public function destroyUser(){
        Admin::findOrFail($this->admin_id)->delete();
        toastr()->success('Admin Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function render(){
        $admins = Admin::get();
        return view('livewire.admin.admins.index', ['admins' => $admins]);
    }
}
