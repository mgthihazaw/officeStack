<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Location_Seeder::class);
        $this->call(Address_Seeder::class);
        $this->call(Person_Business_Seeder::class);
        $this->call(Department_Seeder::class);
        $this->call(Role_Seeder::class);
        $this->call(Business_Type_Seeder::class);
        $this->call(Business_Seeder::class);
        $this->call(Staff_Seeder::class);
        $this->call(Permission_Seeder::class);
    }
}
