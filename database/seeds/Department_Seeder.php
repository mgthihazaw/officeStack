<?php

use Illuminate\Database\Seeder;
use App\Department;

class Department_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
        	'department_name' => 'Sale & Marketing',
        ]);
        Department::create([
        	'department_name' => 'Software Development',
        ]);
        Department::create([
        	'department_name' => 'Service',
        ]);
    }
}
