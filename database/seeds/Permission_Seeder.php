<?php

use Illuminate\Database\Seeder;

class Permission_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
        	'permission' => 'create-service'
        ]);
        DB::table('permissions')->insert([
        	'permission' => 'update-service'
        ]);
        DB::table('permissions')->insert([
        	'permission' => 'view-service'
        ]);


        DB::table('role_has_permissions')->insert([
        	'role_id' => 2,
        	'permission_id' => 2,
        ]);
        DB::table('role_has_permissions')->insert([
        	'role_id' => 2,
        	'permission_id' =>3,
        ]);
        DB::table('role_has_permissions')->insert([
        	'role_id' => 3,
        	'permission_id' => 1,
        ]);
        DB::table('role_has_permissions')->insert([
        	'role_id' => 3,
        	'permission_id' => 2,
        ]);
        DB::table('role_has_permissions')->insert([
        	'role_id' => 3,
        	'permission_id' => 3,
        ]);
    }
}
