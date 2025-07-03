<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\Cctv; // Pastikan namespace model Cctv benar
use App\Exports\AllCctvsExport;       // Panggil kelas export yang baru dibuat
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class CctvExportController extends Controller
{
    /**
     * Menangani permintaan untuk mengekspor data CCTV ke file Excel.
     */
    public function exportExcel(Request $request)
    {
        $kd_region = $request->query('kd_region');
        return Excel::download(new AllCctvsExport($kd_region), 'laporan_cctv.xlsx');
    }

    /**
     * Menangani permintaan untuk mengekspor data CCTV ke file PDF.
     */
    public function exportPdf(Request $request)
    {
        $kd_region = $request->query('kd_region');

        // Ganti 'brand' dan 'region' sesuai dengan nama relasi di model Cctv
        $query = Cctv::with('brand', 'region');

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->get();

        // Arahkan ke view PDF untuk CCTV
        $pdf = PDF::loadView('admin.inventory.cctv.pdf_view', compact('datas'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan_cctv.pdf');
    }
}