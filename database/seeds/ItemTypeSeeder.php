<?php

use Illuminate\Database\Seeder;
use App\ItemType;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemtypes = [
        	['name' => 'Hard Disk'],
        	['name' => 'Memory(RAM)'],
        	['name' => 'Motherboard']
        ];

        foreach($itemtypes as $key => $value){
        	ItemType::create($value);
        }
    }
}
