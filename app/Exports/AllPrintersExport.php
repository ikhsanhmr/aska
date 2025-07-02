<?php

namespace App\Exports;

use App\Models\Admin\Inventory\Printer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllPrintersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $kd_region;

    /**
     * Terima kd_region dari controller. Dibuat opsional dengan default null.
     *
     * @param string|null $kd_region
     */
    public function __construct($kd_region = null)
    {
        $this->kd_region = $kd_region;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Printer::with('getDeviceBrands', 'region');

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
            'Pengguna',
            'Kantor Induk',
            'Status Asset',
            'Vendor',
            'Year',
        ];
    }

    /**
     * @param mixed $printer
     *
     * @return array
     */
    public function map($printer): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $printer->getDeviceBrands->name ?? 'N/A',
            $printer->user_name,
            $printer->region->nama_region ?? 'Tidak ada',
            $printer->ownership_status,
            $printer->vendor,
            $printer->year,
        ];
    }
}
