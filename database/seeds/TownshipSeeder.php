<?php

use Illuminate\Database\Seeder;
use App\Township;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Township::create([
        	'name' => 'ခ်မ္းျမသာစည္ ျမိဳ႕နယ္',
            'state_id' => 9
        ]);

        Township::create([
        	'name' => 'ခ်မ္းေအးသာဇံ ျမိဳ႕နယ္',
            'state_id' => 9
        ]);

        Township::create([
        	'name' => 'မဟာေအာင္ေျမ ျမိဳ႕နယ္',
            'state_id' => 9
        ]);

        Township::create([
        	'name' => 'အမရပူရ ျမိဳ႕နယ္',
            'state_id' => 9
        ]);

        Township::create([
        	'name' => 'ကမာရြတ္ ျမိဳ႕နယ္',
            'state_id' => 3
        ]);
        Township::create([
            'name' => 'တာေမြ ျမိဳ႕နယ္',
            'state_id' => 3
        ]);
        Township::create([
            'name' => 'အင္းစိန္ ျမိဳ႕နယ္',
            'state_id' => 3
        ]);


        Township::create([
            'name' => 'ဖားကန္႕ ျမိဳ႕နယ္',
            'state_id' => 12
        ]);
        Township::create([
            'name' => 'ကန္႕ဘလူ ျမိဳ႕နယ္',
            'state_id' => 12
        ]);
        Township::create([
            'name' => 'မုံရြာ ျမိဳ႕နယ္',
            'state_id' => 12
        ]);
    }
}
