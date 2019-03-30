<?php

use Illuminate\Database\Seeder;
use App\Location;

class Location_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
        	'name' => 'ျမန္မာ',
        ]);

        Location::create([
        	'name' => 'တနသၤာရီတိုင္း',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'မြန္ျပည္နယ္',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ရန္ကုန္တိုင္း',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ဧရာ၀တီတိုင္း',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ကရင္ျပည္နယ္',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ပဲခူးတိုင္း',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ရခိုင္ျပည္နယ္',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'မေကြးတိုင္း',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'မႏၱေလးတိုင္း',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ကယားျပည္နယ္',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ရွမ္းျပည္နယ္',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'စစ္ကုိင္းတိုင္း',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ခ်င္းျပည္နယ္',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ကခ်င္ျပည္နယ္',
        	'location_id' => 1,
        ]);
        Location::create([
        	'name' => 'ေနျပည္ေတာ္',
        	'location_id' => 1,
        ]);

        Location::create([
            'name' => 'ခ်မ္းျမသာစည္',
            'location_id' => 10,
        ]);
        Location::create([
            'name' => 'ခ်မ္းေအးသာစံ',
            'location_id' => 10,
        ]);
        Location::create([
            'name' => 'အမရပူရ',
            'location_id' => 10,
        ]);
        Location::create([
            'name' => 'မဟာေအာင္ေျမ',
            'location_id' => 10,
        ]);

        Location::create([
            'name' => 'အင္းစိန္',
            'location_id' => 4,
        ]);
        Location::create([
            'name' => 'ကမာရြတ္',
            'location_id' => 4,
        ]);
        Location::create([
            'name' => 'စမ္းေခ်ာင္း',
            'location_id' => 4,
        ]);
        Location::create([
            'name' => 'လွည္းတန္း',
            'location_id' => 4,
        ]);

        Location::create([
            'name' => 'စစ္ကုိင္း',
            'location_id' => 13,
        ]);
    }
}
