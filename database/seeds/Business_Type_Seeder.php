<?php

use Illuminate\Database\Seeder;
use App\BusinessType;

class Business_Type_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessType::create([
        	'type' => 'KTV'
        ]);

        BusinessType::create([
        	'type' => 'MI Office'
        ]);
    }
}
