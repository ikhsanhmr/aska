<?php

namespace App\Exports;

use App\Models\Admin\Inventory\Computer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllComputersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        $query = Computer::with('getDeviceBrands', 'getVendor', 'getUnits');

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
            'Computer Name',
            'Spesification',
            'User',
            'Serial Number',
            'IP Address',
            'Kantor Induk',
            'Unit',
            'Asset Status',
            'Vendor',
            'Year',
            'System Operation',
            'Office',
            'Status Join Domain',
            'Kes',
            'Mouse',
            'Keyboard',
            'Monitor',
            'Contract Date',
            'Rental Price',
        ];
    }

    /**
     * @param mixed $computer
     *
     * @return array
     */
    public function map($computer): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $computer->getDeviceBrands->name ?? 'N/A',
            $computer->name,
            $computer->spesification,
            $computer->user_name,
            $computer->serial_number,
            $computer->ip_address,
            $computer->region->nama_region ?? 'Tidak ada',
            $computer->getUnits->nama_unit ?? 'Tidak ada',
            $computer->ownership_status,
            $computer->getVendor->bp_name ?? 'Tidak ada',
            $computer->year,
            $computer->system_operation,
            $computer->office,
            $computer->status_id == 1 ? 'ya' : 'tidak',
            $computer->kes,
            $computer->mouse,
            $computer->keyboard,
            $computer->monitor,
            $computer->contract_date,
            $computer->rental_price,
        ];
    }
}
