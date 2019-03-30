<?php

use Illuminate\Database\Seeder;
use App\Business;

class Business_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
        	'person_business_id' => 4,
        	'business_type_id' => 1,
        ]);
        Business::create([
        	'person_business_id' => 5,
        	'business_type_id' => 2,
        ]);
        Business::create([
        	'person_business_id' => 6,
        	'business_type_id' => 2,
        ]);
    }
}
