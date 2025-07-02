<?php

namespace App\Exports;

use App\Models\Admin\Inventory\Handphone; // PASTIKAN PATH MODEL INI BENAR
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllHandphonesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $kd_region;

    /**
     * Terima kd_region dari controller.
     * @param string|null $kd_region
     */
    public function __construct($kd_region = null)
    {
        $this->kd_region = $kd_region;
    }

    /**
     * Mengambil data dari database.
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mulai query dengan relasi yang benar ('brand' dan 'region')
        $query = Handphone::with('brand', 'region');

        // Terapkan filter HANYA jika kd_region diberikan
        if ($this->kd_region) {
            $query->where('kd_region', $this->kd_region);
        }

        // Eksekusi query dan kembalikan hasilnya
        return $query->get();
    }

    /**
     * Mendefinisikan header untuk kolom Excel.
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Brand',
            'Model',
            'Serial Number',
            'Nama Pegawai',
            'Unit',
            'Status Asset',
        ];
    }

    /**
     * Memetakan data dari setiap baris ke kolom yang sesuai.
     * @param mixed $handphone
     * @return array
     */
    public function map($handphone): array
    {
        static $i = 0;
        $i++;
        
        return [
            $i,
            $handphone->brand->name ?? 'N/A', // Menggunakan relasi 'brand'
            $handphone->model,
            $handphone->serial_number,
            $handphone->nama_pegawai,
            $handphone->region->nama_region ?? 'Tidak ada', // Menggunakan relasi 'region'
            $handphone->status_asset,
        ];
    }
}
