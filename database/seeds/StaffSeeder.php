<?php

use Illuminate\Database\Seeder;
use App\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $staff = Staff::create([
        	'person_business_id' => 7,
            'department_id' => 2,
            'business_id' => 2,
        	'username' => 'thantzinsoe',
        	'password' => bcrypt('thantzinsoe'),
        ]);
        $staff->attachRole(2);


        $staff = Staff::create([
            'person_business_id' => 8,
            'department_id' => 2,
            'business_id' => 2,
            'username' => 'thihazaw',
            'password' => bcrypt('thantzinsoe'),
        ]);
        $staff->attachRole(2);

        $staff = Staff::create([
            'person_business_id' => 10,
            'department_id' => 3,
            'business_id' => 2,
            'username' => 'mgmg',
            'password' => bcrypt('thantzinsoe'),
        ]);
        $staff->attachRole(3);
        
        $staff = Staff::create([
            'person_business_id' => 11,
            'department_id' => 3,
            'business_id' => 2,
            'username' => 'zawzaw',
            'password' => bcrypt('thantzinsoe'),
        ]);
        $staff->attachRole(3);


        $staff = Staff::create([
            'person_business_id' => 12,
            'department_id' => 1,
            'business_id' => 2,
            'username' => 'kyawkyaw',
            'password' => bcrypt('thantzinsoe'),
        ]);
        $staff->attachRole(4);


    }
}
