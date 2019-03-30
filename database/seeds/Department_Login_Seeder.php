<?php

use Illuminate\Database\Seeder;

class Department_Login_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department_login')->insert([
        	'business_id' => 2,
        	'department_id' => 3,
        	'password' => bcrypt('microstack')
        ]);

        DB::table('department_login')->insert([
        	'business_id' => 2,
        	'department_id' => 1,
        	'password' => bcrypt('microstack')
        ]);
    }
}
