<?php

namespace App\Exports;

use App\Models\Monitor; // Sesuaikan dengan path model Monitor Anda
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllMonitorsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        // Mulai query dengan relasi, jangan langsung get()
        $query = Monitor::with('getDeviceBrands', 'region');

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
        // Definisikan header kolom Excel sesuai dengan view Anda
        return [
            'No',
            'Brand',
            'User',
            'Kantor Induk',
            'Status Asset',
            'Vendor',
            'Year',
        ];
    }

    /**
     * @param mixed $monitor
     *
     * @return array
     */
    public function map($monitor): array
    {
        static $i = 0;
        $i++;
        // Map data sesuai urutan header
        return [
            $i,
            $monitor->getDeviceBrands->name ?? 'N/A',
            $monitor->user_name,
            $monitor->region->nama_region ?? 'Tidak ada',
            $monitor->ownership_status,
            $monitor->vendor,
            $monitor->year,
        ];
    }
}
