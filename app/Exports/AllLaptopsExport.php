<?php

namespace App\Exports;

use App\Models\Admin\Inventory\Laptop; // Sesuaikan dengan path model Laptop Anda
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllLaptopsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        // Mulai query, jangan langsung get()
        $query = Laptop::with('getDeviceBrands', 'getUnits');

        // Terapkan filter HANYA jika kd_region diberikan
        if ($this->kd_region) {
            $query->where('kd_region', $this->kd_region);
        }

        // Eksekusi query dan kembalikan hasilnya
        return $query->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Definisikan header kolom Excel
        return [
            'No',
            'Brand',
            'Laptop Name',
            'Spesification',
            'User',
            'Serial Number',
            'IP Address',
            'Unit',
            'Status Asset',
            'Vendor',
            'Year',
        ];
    }

    /**
     * @param mixed $laptop
     *
     * @return array
     */
    public function map($laptop): array
    {
        static $i = 0;
        $i++;
        // Map data sesuai urutan header
        return [
            $i,
            $laptop->getDeviceBrands->name ?? 'N/A',
            $laptop->name,
            $laptop->spesification,
            $laptop->user_name,
            $laptop->serial_number,
            $laptop->ip_address,
            $laptop->getUnits->nama_unit ?? 'Tidak ada',
            $laptop->ownership_status,
            $laptop->vendor,
            $laptop->year,
        ];
    }
}
