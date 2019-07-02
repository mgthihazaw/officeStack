<?php

use Illuminate\Database\Seeder;
use App\BusinessType;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessType::create([
        	'name' => 'KTV'
        ]);

        BusinessType::create([
        	'name' => 'MI Office'
        ]);
    }
}
