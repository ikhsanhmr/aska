<?php

namespace App\Exports;

use App\Models\Admin\Inventory\MotorDinas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllMotorDinasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $kd_region;

    public function __construct($kd_region = null)
    {
        $this->kd_region = $kd_region;
    }

    public function collection()
    {
        $query = MotorDinas::with('brand', 'region');

        if ($this->kd_region) {
            $query->where('kd_region', $this->kd_region);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Brand',
            'Model',
            'Nomor Polisi',
            'Nomor Rangka',
            'Nomor Mesin',
            'Tahun Pembuatan',
            'Warna',
            'Unit',
            'Status Asset',
            'Nama Pegawai',
            'Keterangan',
        ];
    }

    public function map($motorDinas): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $motorDinas->brand->name ?? 'N/A',
            $motorDinas->model,
            $motorDinas->nomor_polisi,
            $motorDinas->nomor_rangka,
            $motorDinas->nomor_mesin,
            $motorDinas->tahun_pembuatan,
            $motorDinas->warna,
            $motorDinas->region->nama_region ?? 'N/A',
            $motorDinas->status_asset,
            $motorDinas->nama_pegawai,
            $motorDinas->keterangan,
        ];
    }
}
