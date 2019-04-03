<?php

use Illuminate\Database\Seeder;
use App\Staff;

class Staff_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::create([
        	'person_business_id' => 7,
        	'role_id' => 1,
        	'username' => 'thantzinsoe',
        	'password' => bcrypt('thantzinsoe'),
        	'business_id' => 2,
        ]);
        Staff::create([
        	'person_business_id' => 8,
        	'role_id' => 1,
        	'username' => 'thihazaw',
        	'password' => bcrypt('thihazaw'),
        	'business_id' => 2,
        ]);

         Staff::create([
            'person_business_id' => 10,
            'role_id' => 2,
            'username' => 'mgmg',
            'password' => bcrypt('thihazaw'),
            'business_id' => 2,
        ]);
         Staff::create([
            'person_business_id' => 11,
            'role_id' => 3,
            'username' => 'zawzaw',
            'password' => bcrypt('thihazaw'),
            'business_id' => 2,
        ]);

    }
}
