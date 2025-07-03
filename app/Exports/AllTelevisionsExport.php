<?php

namespace App\Exports;

use App\Models\Admin\Inventory\Television;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllTelevisionsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $kd_region;

    public function __construct($kd_region = null)
    {
        $this->kd_region = $kd_region;
    }

    public function collection()
    {
        $query = Television::with('brand', 'region');

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
            'Serial Number',
            'Unit',
            'Status Asset',
            'Keterangan',
        ];
    }

    public function map($television): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $television->brand->name ?? 'N/A',
            $television->model,
            $television->serial_number,
            $television->region->nama_region ?? 'N/A',
            $television->status_asset,
            $television->keterangan,
        ];
    }
}
