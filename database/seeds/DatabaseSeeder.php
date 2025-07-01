<?php

use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Vendor;
use Database\Seeders\AreaSeeder;
use Database\Seeders\RegionSeeder;
use Database\Seeders\UnitSeeder;
use Database\Seeders\UserSeeder;
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
        // $this->call(UsersTableSeeder::class);
        Vendor::factory(30)->create();
        DeviceBrand::factory(5)->create();
        $this->call([
            RegionSeeder::class,
            AreaSeeder::class,
            UnitSeeder::class,
            UserSeeder::class
        ]);
    }
}