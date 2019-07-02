<?php

use Illuminate\Database\Seeder;
use App\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
        	'name' => 'တနသၤာရီတိုင္း',
        ]);
        State::create([
        	'name' => 'မြန္ျပည္နယ္',
        ]);
        State::create([
        	'name' => 'ရန္ကုန္တိုင္း',
        ]);
        State::create([
        	'name' => 'ဧရာ၀တီတိုင္း',
        ]);
        State::create([
        	'name' => 'ကရင္ျပည္နယ္',
        ]);
        State::create([
        	'name' => 'ပဲခူးတိုင္း',
        ]);
        State::create([
        	'name' => 'ရခိုင္ျပည္နယ္',
        ]);
        State::create([
        	'name' => 'မေကြးတိုင္း',
        ]);
        State::create([
        	'name' => 'မႏၱေလးတိုင္း',
        ]);
        State::create([
        	'name' => 'ကယားျပည္နယ္',
        ]);
        State::create([
        	'name' => 'ရွမ္းျပည္နယ္',
        ]);
        State::create([
        	'name' => 'စစ္ကုိင္းတိုင္း',
        ]);
        State::create([
        	'name' => 'ခ်င္းျပည္နယ္',
        ]);
        State::create([
        	'name' => 'ကခ်င္ျပည္နယ္',
        ]);
        State::create([
        	'name' => 'ေနျပည္ေတာ္',
        ]);
    }
}
