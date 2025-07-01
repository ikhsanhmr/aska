<?php

namespace Database\Seeders;

use App\Models\Admin\MasterData\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=10; $i < 20; $i++) { 
            Area::create([
                "kd_region" => mt_rand(1,9),
                "kd_area" => $i,
                "nama_area" => "Area " . $i,
            ]);
        }
    }
}
