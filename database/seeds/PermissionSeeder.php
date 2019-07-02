<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Role
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'role-list',
                'display_name' => 'Display Role Listing',
                'description' => 'List All Roles'
            ],
            [
                'name' => 'role-update',
                'display_name' => 'Update Role',
                'description' => 'Update Role Information'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ],
            // Staff
            [
                'name' => 'staff-create',
                'display_name' => 'Create Staff',
                'description' => 'Create New Staff'
            ],
            [
                'name' => 'staff-list',
                'display_name' => 'Display Staff Listing',
                'description' => 'List All Staff'
            ],
            [
                'name' => 'staff-update',
                'display_name' => 'Update Staff',
                'description' => 'Update Staff Information'
            ],
            [
                'name' => 'staff-delete',
                'display_name' => 'Delete Staff',
                'description' => 'Delete Staff'
            ],
            // Services
            [
                'name' => 'service-create',
                'display_name' => 'Create Service',
                'description' => 'Create New Service'
            ],
            [
                'name' => 'service-list',
                'display_name' => 'Display Service Listing',
                'description' => 'List All Service'
            ],
            [
                'name' => 'service-update',
                'display_name' => 'Update Service',
                'description' => 'Update Service Information'
            ],
            [
                'name' => 'service-delete',
                'display_name' => 'Delete Service',
                'description' => 'Delete Service Information'
            ],
            // Item
            [
                'name' => 'item-create',
                'display_name' => 'Create Item',
                'description' => 'Create New Item'
            ],
            [
                'name' => 'item-list',
                'display_name' => 'Display Item Listing',
                'description' => 'List All Item'
            ],
            [
                'name' => 'item-update',
                'display_name' => 'Update Item',
                'description' => 'Update Item Information'
            ],
            [
                'name' => 'item-delete',
                'display_name' => 'Delete Item',
                'description' => 'Delete Item Information'
            ]
        ];
        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }
    }
}
