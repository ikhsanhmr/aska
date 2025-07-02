<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\Handphone; // PASTIKAN PATH MODEL INI BENAR
use App\Exports\AllHandphonesExport;       // Class Export yang akan kita buat
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class HandphoneExportController extends Controller
{
    /**
     * Menangani permintaan untuk mengekspor data handphone ke file Excel.
     */
    public function exportExcel(Request $request)
    {
        // Ambil kd_region dari parameter URL. Akan bernilai null jika tidak ada.
        $kd_region = $request->query('kd_region');
        
        // Buat nama file dinamis
        $fileName = 'laporan_handphone_' . date('Ymd_His') . '.xlsx';
        
        // Teruskan kd_region ke class export dan unduh file
        return Excel::download(new AllHandphonesExport($kd_region), $fileName);
    }

    /**
     * Menangani permintaan untuk mengekspor data handphone ke file PDF.
     */
    public function exportPdf(Request $request)
    {
        // Ambil kd_region dari parameter URL.
        $kd_region = $request->query('kd_region');

        // Mulai query dengan relasi yang dibutuhkan ('brand' dan 'region')
        $query = Handphone::with('brand', 'region');

        // Terapkan filter HANYA jika kd_region diberikan
        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }
        
        // Ambil data hasil query
        $datas = $query->get();

        // Load view Blade yang didesain untuk PDF dan kirimkan datanya
        $pdf = PDF::loadView('admin.inventory.handphone.pdf_view', compact('datas'));
        
        // Atur ukuran kertas dan orientasi
        $pdf->setPaper('a4', 'landscape');

        // Buat nama file dinamis
        $fileName = 'laporan_handphone_' . date('Ymd_His') . '.pdf';

        // Kembalikan sebagai file PDF untuk diunduh
        return $pdf->download($fileName);
    }
}
