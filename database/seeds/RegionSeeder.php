<?php

namespace Database\Seeders;

use App\Models\Admin\MasterData\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
            INSERT INTO `master_region` (`id`, `kd_region`, `nama_region`, `created_at`, `updated_at`) VALUES
                (13,'03','UP KALIMANTAN 1',NULL,'2024-01-31 05:51:43'),
                (14,'04','UP KALIMANTAN 2',NULL,'2024-01-31 05:51:43'),
                (15,'05','UP KALIMANTAN 3',NULL,'2024-01-31 05:51:43'),
                (16,'02','UP SULAWESI 1',NULL,'2024-01-31 05:51:43'),
                (17,'01','UP SULAWESI 2',NULL,'2024-01-31 05:51:43'),
                (18,'07','UP NUSA TENGGARA',NULL,'2024-01-31 05:51:43'),
                (19,'08','UP PAPUA',NULL,'2024-01-31 05:51:43'),
                (20,'10','UP MALUKU',NULL,NULL),
                (21,'11','UP MALUKU UTARA',NULL,'2024-01-31 05:51:43');
        ");
    }
}
