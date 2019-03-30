<?php

use Illuminate\Database\Seeder;
use App\Role;

class Role_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'name' => 'Developer',
            'department_id' => 2
        ]);
        Role::create([
        	'name' => 'Service Engineer',
            'department_id' => 3
        ]);
        Role::create([
        	'name' => 'အေရာင္းစာေရး',
            'department_id' => 1
        ]);
    }
}
