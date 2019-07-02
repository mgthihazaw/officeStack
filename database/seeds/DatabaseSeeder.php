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
        $this->call(StateSeeder::class);
        $this->call(TownshipSeeder::class);
        $this->call(PersonBusinessSeeder::class);
        $this->call(BusinessTypeSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(StaffSeeder::class);
    }
}
