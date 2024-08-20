<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Create Permissions
        $permissions = [
            'View Dashboard',
            'View RFID Checker',
            'View Analytics',
            'View Attendances',
            'View Current Attendances',

            'View Sections',
            'Create Sections',
            'Update Sections',
            'Delete Sections',

            'View Courses',
            'Create Courses',
            'Update Courses',
            'Delete Courses',

            'View Students',
            'Create Students',
            'Update Students',
            'Delete Students',
            'Add Tag UID to Students',
            'Disable RFID',

            'View Instructors',
            'Create Instructors',
            'Update Instructors',
            'Delete Instructors',
            'Add Tag UID to Instructors',

            'View Events',
            'Create Events',
            'Update Events',
            'Delete Events',

            'View Regular Schedules',
            'Create Regular Schedules',
            'Update Regular Schedules',
            'Delete Regular Schedules',

            'View Make-Up Schedules',
            'Create Make-Up Schedules',
            'Update Make-Up Schedules',
            'Delete Make-Up Schedules',

            'View Make-Up SchedApprovals',
            'Approve Make-Up SchedApprovals',
            'Decline Make-Up SchedApprovals',

            'View Admins',
            'Create Admins',
            'Update Admins',
            'Delete Admins',

            'Add Permissions',
            'View Roles',
            'Create Roles',
            'Update Roles',
            'Delete Roles',

            'View Permissions',
            'Create Permissions',
            'Update Permissions',
            'Delete Permissions',

            'View Logs',

            'View Settings',
            'Update Settings'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }


        // Create Roles
        $superAdminRole = Role::create(['name' => 'Super-Admin', 'guard_name' => 'admin']);
        Role::create(['name' => 'Admin', 'guard_name' => 'admin']);
        Role::create(['name' => 'Staff', 'guard_name' => 'admin']);

        // Let's Give all permissions to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();
        $superAdminRole->givePermissionTo($allPermissionNames);

        // Create the Super-Admin Credentials.
        $superAdminUser = Admin::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'name' => 'Super-Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
            'admin_theme' => 'light'
        ]);

        // Assign the Role to Super-Admin
        $superAdminUser->assignRole($superAdminRole);
    }
}
