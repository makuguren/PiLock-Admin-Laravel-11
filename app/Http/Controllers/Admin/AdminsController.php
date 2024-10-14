<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Create Admins', only: ['create', 'store']),
            new Middleware('permission:Update Admins', only: ['edit', 'update']),
        ];
    }

    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('livewire.admin.admins.create', ['roles' => $roles]);
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|integer',
            'email' => 'required|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $admin = Admin::create([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'gender' => $request->gender,
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|integer',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
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
