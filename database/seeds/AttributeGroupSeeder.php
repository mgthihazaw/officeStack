<?php

use Illuminate\Database\Seeder;
use App\AttributeGroup;

class AttributeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attribute_groups = [
        	[
        		'name' => 'Interface Type',
        		'item_type_id' => 1
        	],
        	[
        		'name' => 'Storage Capacity',
        		'item_type_id' => 1
        	],
        	[
        		'name' => 'Storage Type',
        		'item_type_id' => 1
        	],
        	[
        		'name' => 'Form Factor',
        		'item_type_id' => 1
        	],
        	[
        		'name' => 'Disk Rotatiional Speed',
        		'item_type_id' => 1
        	],
        	[
        		'name' => 'Series',
        		'item_type_id' => 1
        	],
        	[
        		'name' => 'Cache Memory',
        		'item_type_id' => 1
        	],
        	[
        		'name' => 'RAM Type',
        		'item_type_id' => 2
        	],
        	[
        		'name' => 'Storage Capacity',
        		'item_type_id' => 2
        	],
        	[
        		'name' => 'RAM Speed',
        		'item_type_id' => 2
        	],
        	[
        		'name' => 'Chipset Type',
        		'item_type_id' => 3
        	],
        	[
        		'name' => 'RAM Memory Technology',
        		'item_type_id' => 3
        	],
        	[
        		'name' => 'Processor Socket',
        		'item_type_id' => 3
        	],
        ];

        foreach ($attribute_groups as $key => $value) {
        	AttributeGroup::create($value);
        }
    }
}
