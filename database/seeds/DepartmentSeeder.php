<?php

use Illuminate\Database\Seeder;
use App\Department;
use App\Business;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $mdy_office = Business::findOrFail(2);
        $ygn_office = Business::findOrFail(3);

        $departments = [
            [
                'name' => 'Sale & Marketing',
            ],
            [
                'name' => 'Software Development',
            ],
            [
                'name' => 'Service',
            ],
        ];

        foreach($departments as $key => $value){
            $dept = Department::create($value);
            $mdy_office->departments()->attach($dept);
            $ygn_office->departments()->attach($dept);
        }
    }
}
