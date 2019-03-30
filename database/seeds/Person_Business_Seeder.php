<?php

use Illuminate\Database\Seeder;
use App\Person;

class Person_Business_Seeder extends Seeder
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
            'address_id' => 1,
        ]);
        Person::create([
            'name' => 'Microstack Office(Mandalay)',
            'person_business_id' => 3,
            'phone' => '09-3738743434,09-43847348734',
            'address_id' => 4,
        ]);
        Person::create([
            'name' => 'Microstack Office(Yangon)',
            'person_business_id' => 3,
            'phone' => '09-3738743434,09-43847348734',
            'address_id' => 5
        ]);

        Person::create([
            'name' => 'သန္႔ဇင္စိုး',
            'person_business_id' => 2,
            'phone' => '၀၉-၉၇၈၂၂၅၇၆၂,၀၉-၆၉၂၆၉၄၀၄၃',
            'address_id' => 5
        ]);
        Person::create([
            'name' => 'သီဟေဇာ္',
            'person_business_id' => 2,
            'phone' => '၀၉-၆၉၂၅၈၆၀၉၅',
            'address_id' => 5
        ]);
        Person::create([
            'name' => 'မိုးဆန္းဦး',
            'person_business_id' => 2,
            'phone' => '၀၉-၉၉၈၈၇၇၈၈',
            'address_id' => 5
        ]);

        Person::create([
            'name' => 'ေမာင္ေမာင္',
            'person_business_id' => 2,
            'phone' => '၀၉-၉၇၈၂၂၅၇၆၂,၀၉-၆၉၂၆၉၄၀၄၃',
            'address_id' => 5
        ]);
        Person::create([
            'name' => 'ေဇာ္ေဇာ္',
            'person_business_id' => 2,
            'phone' => '၀၉-၆၉၂၅၈၆၀၉၅',
            'address_id' => 5
        ]);
        Person::create([
            'name' => 'ေက်ာ္ေက်ာ္',
            'person_business_id' => 2,
            'phone' => '၀၉-၉၉၈၈၇၇၈၈',
            'address_id' => 5
        ]);
    }
}
