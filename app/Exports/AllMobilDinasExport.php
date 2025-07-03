<?php

namespace App\Exports;

use App\Models\Admin\Inventory\MobilDinas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllMobilDinasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $kd_region;

    public function __construct($kd_region = null)
    {
        $this->kd_region = $kd_region;
    }

    public function collection()
    {
        $query = MobilDinas::with('brand', 'region');

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

    public function map($mobilDinas): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $mobilDinas->brand->name ?? 'N/A',
            $mobilDinas->model,
            $mobilDinas->nomor_polisi,
            $mobilDinas->nomor_rangka,
            $mobilDinas->nomor_mesin,
            $mobilDinas->tahun_pembuatan,
            $mobilDinas->warna,
            $mobilDinas->region->nama_region ?? 'N/A',
            $mobilDinas->status_asset,
            $mobilDinas->nama_pegawai,
            $mobilDinas->keterangan,
        ];
    }
}
