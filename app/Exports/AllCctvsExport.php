<?php

namespace App\Exports;

use App\Models\Admin\Inventory\Cctv; // Pastikan namespace model Cctv benar
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllCctvsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        // Ganti 'brand' dan 'region' sesuai dengan nama relasi di model Cctv
        $query = Cctv::with('brand', 'region');

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
            'Nama',
            'Model',
            'Nomor Seri',
            'Alamat IP',
            'Unit',
            'Tanggal Instalasi',
            'Status CCTV',
        ];
    }

    /**
     * @param mixed $cctv
     *
     * @return array
     */
    public function map($cctv): array
    {
        static $i = 0;
        $i++;
        return [
            $i,
            $cctv->brand->name ?? 'N/A',
            $cctv->nama,
            $cctv->model,
            $cctv->nomor_seri,
            $cctv->alamat_ip,
            $cctv->region->nama_region ?? 'Tidak ada',
            $cctv->tanggal_instalasi,
            $cctv->status_cctv,
        ];
    }
}