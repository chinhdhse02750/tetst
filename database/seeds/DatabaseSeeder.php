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
        $this->call(RolePermissionSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(UpdatePublicIdOffer::class);
        $this->call(PrefSeeder::class);
    }
}
