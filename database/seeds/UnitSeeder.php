<?php

namespace Database\Seeders;

use App\Models\Admin\MasterData\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=20; $i < 30; $i++) { 
            Unit::create([
                "kd_region" => mt_rand(1,9),
                "kd_area" => mt_rand(10,19),
                "kd_unit" => $i,
                "nama_unit" => "Unit " . $i,
            ]);
        }
    }
}
