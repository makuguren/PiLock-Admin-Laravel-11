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
        ], [
            'first_name.required' => 'The first name field is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',
            'last_name.required' => 'The last name field is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',
            'gender.required' => 'The gender field is required.',
            'gender.integer' => 'The gender must be an integer.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.max' => 'The password may not be greater than 20 characters.',
            'roles.required' => 'The roles field is required.'
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
            'email' => 'required|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ], [
            'first_name.required' => 'The first name field is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',
            'last_name.required' => 'The last name field is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',
            'gender.required' => 'The gender field is required.',
            'gender.integer' => 'The gender must be an integer.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.max' => 'The password may not be greater than 20 characters.',
            'roles.required' => 'The roles field is required.'
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
