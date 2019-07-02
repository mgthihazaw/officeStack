<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin Role
        $role = ['name' => 'admin', 'display_name' => 'Admin', 'description' => 'Full Permission'];
        $role = Role::create($role);
        $permission = Permission::get();
        foreach ($permission as $key => $value) {
            $role->attachPermission($value);
        }
        
        // Developer Role
        $role = ['name' => 'developer', 'display_name' => 'Developer', 'description' => 'Full Permission'];
        $role = Role::create($role);
        $permission = Permission::get();
        foreach ($permission as $key => $value) {
            $role->attachPermission($value);
        }

        // Service Engineer Role
        $role = ['name' => 'service_engineer', 'display_name' => 'Service Engineer', 'description' => 'Associated with services'];
        $role = Role::create($role);
        $permission = Permission::where('name', 'service-list')->orWhere('name', 'service-update')->get();
        foreach ($permission as $key => $value) {
            $role->attachPermission($value);
        }

        // Receptionist Role
        $role = ['name' => 'receptionist', 'display_name' => 'Receptionist', 'description' => 'Associated with services and Item Sales'];
        $role = Role::create($role);
        $permission = Permission::where('name', 'LIKE', '%service%')->orWhere('name','LIKE', '%item%')->get();
        foreach ($permission as $key => $value) {
            $role->attachPermission($value);
        }
    }
}
