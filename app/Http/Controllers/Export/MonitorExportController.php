<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Monitor; // Sesuaikan dengan path Model Monitor Anda
use App\Exports\AllMonitorsExport;       // Panggil class Export yang akan kita buat
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF; // Facade dari barryvdh/laravel-dompdf

class MonitorExportController extends Controller
{
    /**
     * Menangani permintaan untuk mengekspor data monitor ke file Excel.
     */
    public function exportExcel(Request $request)
    {
        // Ambil kd_region dari URL. Akan bernilai null jika tidak ada.
        $kd_region = $request->query('kd_region');
        
        // Teruskan kd_region (bisa null) ke class export.
        return Excel::download(new AllMonitorsExport($kd_region), 'laporan_monitor.xlsx');
    }

    /**
     * Menangani permintaan untuk mengekspor data monitor ke file PDF.
     */
    public function exportPdf(Request $request)
    {
        // Ambil kd_region dari URL.
        $kd_region = $request->query('kd_region');

        // Mulai query dengan relasi yang dibutuhkan
        $query = Monitor::with('getDeviceBrands', 'region');

        // Terapkan filter HANYA jika kd_region diberikan
        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }
        
        // Ambil data hasil query
        $datas = $query->get();

        // Load view Blade yang didesain untuk PDF dan kirimkan datanya
        $pdf = PDF::loadView('admin.inventory.monitors.pdf_view', compact('datas'));
        
        // Atur ukuran kertas dan orientasi
        $pdf->setPaper('a4', 'landscape');

        // Kembalikan sebagai file PDF untuk diunduh
        return $pdf->download('laporan_monitor.pdf');
    }
}
