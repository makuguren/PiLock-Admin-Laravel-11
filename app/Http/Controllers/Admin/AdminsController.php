<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view user', ['only' => ['index']]);
    //     $this->middleware('permission:create user', ['only' => ['create','store']]);
    //     $this->middleware('permission:update user', ['only' => ['update','edit']]);
    //     $this->middleware('permission:delete user', ['only' => ['destroy']]);
    // }

    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('livewire.admin.admins.create', ['roles' => $roles]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $admin = Admin::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);

        $admin->syncRoles($request->roles);
        toastr()->success('Admin Created Successfully with Roles');
        return redirect()->route('admin.admins.index');
    }

    public function edit(Admin $admin){
        $roles = Role::pluck('name','name')->all();
        $adminRoles = $admin->roles->pluck('name','name')->all();
        return view('livewire.admin.admins.edit', [
            'admin' => $admin,
            'roles' => $roles,
            'userRoles' => $adminRoles
        ]);
    }

    public function update(Request $request, Admin $admin){
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)){
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $admin->update($data);
        $admin->syncRoles($request->roles);
        toastr()->success('Admin Updated Successfully with roles');
        return redirect()->route('admin.admins.index');
    }

    public function destroy($adminId){
        $admin = Admin::findOrFail($adminId);
        $admin->delete();
        toastr()->success('Admin Deleted Successfully');
        return redirect()->route('admin.admins.index');
    }
}
