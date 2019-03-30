<?php

use Illuminate\Database\Seeder;
use App\Address;

class Address_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
        	'home_no' => 'No.21',
        	'block' => 'Block A',
        	'street' => 'Between 27x28th Street,78th Street',
        	'location_id' => 17
        ]);

        Address::create([
        	'home_no' => 'No.13',
        	'block' => 'Block C',
        	'street' => 'Sapal Street',
        	'location_id' => 19
        ]);

        Address::create([
        	'home_no' => 'No.19',
        	'block' => 'Block B',
        	'street' => 'Bayint Naung Street',
        	'location_id' => 25
        ]);

        Address::create([
        	'home_no' => 'Ma-7/21',
        	'block' => 'Block A',
        	'street' => '62nd Street,Bet Theikpan Street x Sabal Street',
        	'location_id' => 17
        ]);

        Address::create([
        	'home_no' => 'No.24',
        	'block' => 'Block A',
        	'street' => 'Apple Street',
        	'location_id' => 22,
        ]);
    }
}
