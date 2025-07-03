<?php

namespace App\Exports;

use App\Models\Admin\Inventory\Gedung; // Sesuaikan namespace jika perlu
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllGedungsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        $query = Gedung::with('region');

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
            'Nama',
            'Alamat',
            'Unit',
            'Status Asset',
        ];
    }

    /**
     * @param mixed $gedung
     *
     * @return array
     */
    public function map($gedung): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $gedung->nama,
            $gedung->alamat,
            $gedung->region->nama_region ?? 'Tidak ada',
            $gedung->status_asset,
        ];
    }
}   