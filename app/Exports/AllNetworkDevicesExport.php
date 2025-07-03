<?php

namespace App\Exports;

use App\Models\Admin\Inventory\NetworkDevice; // Sesuaikan namespace jika perlu
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllNetworkDevicesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $kd_region;

    public function __construct($kd_region = null)
    {
        $this->kd_region = $kd_region;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Sesuaikan nama relasi dengan yang ada di model NetworkDevice Anda
        $query = NetworkDevice::with('getDeviceBrands', 'getUnits', 'getVendor', 'region');

        if ($this->kd_region) {
            $query->where('kd_region', $this->kd_region);
        }

        return $query->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Brand',
            'Device Type',
            'IP Address',
            'Username',
            'Password',
            'Pengguna',
            'Nama Unit',
            'Status Aset',
            'Vendor',
            'Tahun',
        ];
    }

    /**
     * @param mixed $device
     *
     * @return array
     */
    public function map($device): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $device->getDeviceBrands->name ?? 'N/A',
            $device->device_type,
            $device->ip_address,
            $device->user_name,
            $device->password,
            $device->username, // Kolom pengguna
            $device->getUnits->nama_unit ?? 'Tidak ada',
            $device->ownership_status,
            $device->getVendor->bp_name ?? 'Aset PLN', // Sesuaikan dengan nama kolom di tabel vendor
            $device->year,
        ];
    }
}