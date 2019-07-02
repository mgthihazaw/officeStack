<?php

use Illuminate\Database\Seeder;
use App\Person;

class PersonBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Person::create([
        	'name' => 'Root',
        	'person_business_id' => 1,
        ]);
        Person::create([
        	'name' => 'Person',
        	'person_business_id' => 1,
        ]);
        Person::create([
        	'name' => 'Business',
        	'person_business_id' => 1,
        ]);

        Person::create([
            'name' => 'Jazz Palace',
            'person_business_id' => 3,
            'phone' => '09-3738743434,09-43847348734',
            'address_line' => "Ma-7/21, Block A, 62nd Street,Between Theikpan Street & Sabal Street",
            'township_id' => 1
        ]);
        Person::create([
            'name' => 'Microstack Office(Mandalay)',
            'person_business_id' => 3,
            'phone' => '09-3738743434,09-43847348734',
            'address_line' => "၆၃လမ္းx၆၄လမ္းၾကား ပိေတာက္လမ္း",
            'township_id' => 1
        ]);
        Person::create([
            'name' => 'Microstack Office(Yangon)',
            'person_business_id' => 3,
            'phone' => '09-3738743434,09-43847348734',
            'address_line' => "အမွတ္(၂၃) နတ္ေခ်ာင္းလမ္း",
            'township_id' => 6
        ]);

        Person::create([
            'name' => 'သန္႕ဇင္စိုး',
            'person_business_id' => 2,
            'phone' => '09-978225762,09-692694043',
            'address_line' => "ဆားခ်က္ရပ္ကြက္",
            'township_id' => 4
        ]);
        Person::create([
            'name' => 'သီဟေဇာ္',
            'person_business_id' => 2,
            'phone' => '၀၉-၆၉၂၅၈၆၀၉၅',
            'address_line' => "အမွတ္(၃) ရပ္ကြက္",
            'township_id' => 10
        ]);
        Person::create([
            'name' => 'မိုးဆန္းဦး',
            'person_business_id' => 2,
            'phone' => '၀၉-၉၉၈၈၇၇၈၈',
            'address_line' => "အမွတ္(၈) ရပ္ကြက္",
            'township_id' => 10
        ]);

        Person::create([
            'name' => 'ေမာင္ေမာင္',
            'person_business_id' => 2,
            'phone' => '၀၉_၉၇၈၂၂၅၇၆၂,၀၉_၆၉၂၆၉၄၀၄၃',
            'address_line' => "ေအာင္ခ်မ္းသာရပ္ကြက္",
            'township_id' => 3
        ]);
        Person::create([
            'name' => 'ေဇာ္ေဇာ္',
            'person_business_id' => 2,
            'phone' => '၀၉-၆၉၂၅၈၆၀၉၅',
            "address_line" => "ေစ်းခ်ိဳရပ္ကြက္",
            'township_id' => 2
        ]);
        Person::create([
            'name' => 'ေက်ာ္ေက်ာ္',
            'person_business_id' => 2,
            'phone' => '၀၉_၉၉၈၈၇၇၈၈',
            "address_line" => "ျမင့္မိုရ္ရပ္ကြက္",
            'township_id' => 1
        ]);
    }
}
