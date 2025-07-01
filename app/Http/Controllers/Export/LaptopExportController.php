<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\Laptop; // Sesuaikan dengan path Model Laptop Anda
use App\Exports\AllLaptopsExport;         // Panggil class Export yang sudah dibuat
use Illuminate\Http\Request; // <-- 1. Tambahkan Request untuk membaca parameter URL
use Maatwebsite\Excel\Facades\Excel;
use PDF; // Facade dari barryvdh/laravel-dompdf

class LaptopExportController extends Controller
{
    /**
     * Menangani permintaan untuk mengekspor data laptop ke file Excel.
     */
    public function exportExcel(Request $request)
    {
        // 2. Ambil kd_region dari URL. Akan bernilai null jika tidak ada.
        $kd_region = $request->query('kd_region');
        
        // 3. Teruskan kd_region (bisa null) ke class export.
        return Excel::download(new AllLaptopsExport($kd_region), 'laporan_laptop.xlsx');
    }

    /**
     * Menangani permintaan untuk mengekspor data laptop ke file PDF.
     */
    public function exportPdf(Request $request)
    {
        // Ambil kd_region dari URL.
        $kd_region = $request->query('kd_region');

        // Mulai query
        $query = Laptop::with('getDeviceBrands', 'getUnits');

        // Terapkan filter HANYA jika kd_region diberikan
        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }
        
        // Ambil data hasil query
        $datas = $query->get();

        // Load view Blade yang didesain untuk PDF dan kirimkan datanya
        $pdf = PDF::loadView('admin.inventory.laptops.pdf_view', compact('datas'));
        
        // Atur ukuran kertas dan orientasi
        $pdf->setPaper('a4', 'landscape');

        // Kembalikan sebagai file PDF untuk diunduh
        return $pdf->download('laporan_laptop.pdf');
    }
}
