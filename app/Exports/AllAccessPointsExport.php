<?php

namespace App\Exports;

use App\Models\Admin\Inventory\AccessPoint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllAccessPointsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $kd_region;
    protected $unit_id;

    public function __construct($kd_region = null, $unit_id = null)
    {
        $this->kd_region = $kd_region;
        $this->unit_id = $unit_id;
    }

    public function collection()
    {
        $query = AccessPoint::with('region');

        if ($this->kd_region) {
            $query->where('kd_region', $this->kd_region);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Access Point / WIFI',
            'Model',
            'Nomor Seri',
            'Mac Address',
            'Alamat IP',
            'Unit',
            'Status',
            'Status Asset',
        ];
    }

    public function map($accessPoint): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $accessPoint->nama_ap,
            $accessPoint->model,
            $accessPoint->nomor_seri,
            $accessPoint->mac_address,
            $accessPoint->alamat_ip,
            $accessPoint->region->nama_region ?? 'Tidak ada',
            $accessPoint->status,
            $accessPoint->status_asset,
        ];
    }
}
