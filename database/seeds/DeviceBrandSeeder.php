<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceBrandSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $brands = [
            // Laptops
            ['name' => 'Asus', 'category' => 'laptop'],
            ['name' => 'Acer', 'category' => 'laptop'],
            ['name' => 'HP', 'category' => 'laptop'],
            ['name' => 'Dell', 'category' => 'laptop'],
            ['name' => 'Lenovo', 'category' => 'laptop'],
            ['name' => 'Apple', 'category' => 'laptop'],
            ['name' => 'MSI', 'category' => 'laptop'],
            ['name' => 'Microsoft', 'category' => 'laptop'],

            // Komputer
            ['name' => 'HP', 'category' => 'komputer'],
            ['name' => 'Dell', 'category' => 'komputer'],
            ['name' => 'Lenovo', 'category' => 'komputer'],
            ['name' => 'Asus', 'category' => 'komputer'],
            ['name' => 'Acer', 'category' => 'komputer'],

            // Monitor
            ['name' => 'LG', 'category' => 'monitor'],
            ['name' => 'Samsung', 'category' => 'monitor'],
            ['name' => 'AOC', 'category' => 'monitor'],
            ['name' => 'Dell', 'category' => 'monitor'],
            ['name' => 'Asus', 'category' => 'monitor'],
            ['name' => 'BenQ', 'category' => 'monitor'],
            ['name' => 'ViewSonic', 'category' => 'monitor'],

            // Printer
            ['name' => 'Canon', 'category' => 'printer'],
            ['name' => 'Epson', 'category' => 'printer'],
            ['name' => 'HP', 'category' => 'printer'],
            ['name' => 'Brother', 'category' => 'printer'],
            ['name' => 'Fuji Xerox', 'category' => 'printer'],

            // Server
            ['name' => 'Dell', 'category' => 'server'],
            ['name' => 'HP', 'category' => 'server'],
            ['name' => 'IBM', 'category' => 'server'],
            ['name' => 'Lenovo', 'category' => 'server'],
            ['name' => 'Cisco', 'category' => 'server'],

            // Network Device
            ['name' => 'Cisco', 'category' => 'network device'],
            ['name' => 'TP-Link', 'category' => 'network device'],
            ['name' => 'MikroTik', 'category' => 'network device'],
            ['name' => 'D-Link', 'category' => 'network device'],
            ['name' => 'Ubiquiti', 'category' => 'network device'],
            ['name' => 'Huawei', 'category' => 'network device'],

            // Handphone
            ['name' => 'Samsung', 'category' => 'handphone'],
            ['name' => 'Apple', 'category' => 'handphone'],
            ['name' => 'Xiaomi', 'category' => 'handphone'],
            ['name' => 'Oppo', 'category' => 'handphone'],
            ['name' => 'Vivo', 'category' => 'handphone'],
            ['name' => 'Realme', 'category' => 'handphone'],
            ['name' => 'OnePlus', 'category' => 'handphone'],
            ['name' => 'Huawei', 'category' => 'handphone'],
            ['name' => 'Infinix', 'category' => 'handphone'],

            // TV
            ['name' => 'Samsung', 'category' => 'tv'],
            ['name' => 'LG', 'category' => 'tv'],
            ['name' => 'Sony', 'category' => 'tv'],
            ['name' => 'Sharp', 'category' => 'tv'],
            ['name' => 'Panasonic', 'category' => 'tv'],
            ['name' => 'TCL', 'category' => 'tv'],

            // Mobil
            ['name' => 'Toyota', 'category' => 'mobil'],
            ['name' => 'Honda', 'category' => 'mobil'],
            ['name' => 'Suzuki', 'category' => 'mobil'],
            ['name' => 'Mitsubishi', 'category' => 'mobil'],
            ['name' => 'Daihatsu', 'category' => 'mobil'],
            ['name' => 'Hyundai', 'category' => 'mobil'],
            ['name' => 'Wuling', 'category' => 'mobil'],
            ['name' => 'Nissan', 'category' => 'mobil'],

            // Motor
            ['name' => 'Yamaha', 'category' => 'motor'],
            ['name' => 'Honda', 'category' => 'motor'],
            ['name' => 'Suzuki', 'category' => 'motor'],
            ['name' => 'Kawasaki', 'category' => 'motor'],
            ['name' => 'Vespa', 'category' => 'motor'],

            // CCTV
            ['name' => 'Hikvision', 'category' => 'cctv'],
            ['name' => 'Dahua', 'category' => 'cctv'],
            ['name' => 'Axis', 'category' => 'cctv'],
            ['name' => 'CP Plus', 'category' => 'cctv'],
            ['name' => 'EZVIZ', 'category' => 'cctv'],
            ['name' => 'Panasonic', 'category' => 'cctv'],
        ];

        foreach ($brands as &$brand) {
            $brand['created_at'] = $now;
            $brand['updated_at'] = $now;
        }

        DB::table('device_brands')->insert($brands);
    }
}
