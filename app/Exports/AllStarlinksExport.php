<?php

namespace App\Exports;

use App\Models\Admin\Inventory\Starlink; // Pastikan namespace model Starlink benar
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllStarlinksExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        $query = Starlink::with('region'); // Hanya butuh relasi 'region'

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
            'Model',
            'Nomor Seri',
            'Unit',
            'Tanggal Pemasangan',
            'Status Asset',
        ];
    }

    /**
     * @param mixed $starlink
     *
     * @return array
     */
    public function map($starlink): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $starlink->model,
            $starlink->nomor_seri,
            $starlink->region->nama_region ?? 'Tidak ada',
            $starlink->tanggal_pemasangan,
            $starlink->status,
        ];
    }
}