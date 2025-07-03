<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\Starlink; // Sesuaikan namespace
use App\Exports\AllStarlinksExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class StarlinkExportController extends Controller
{
    /**
     * Menangani permintaan untuk mengekspor data Starlink ke file Excel.
     */
    public function exportExcel(Request $request)
    {
        $kd_region = $request->query('kd_region');
        return Excel::download(new AllStarlinksExport($kd_region), 'laporan_starlink.xlsx');
    }

    /**
     * Menangani permintaan untuk mengekspor data Starlink ke file PDF.
     */
    public function exportPdf(Request $request)
    {
        $kd_region = $request->query('kd_region');

        $query = Starlink::with('region');

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->get();

        // Arahkan ke view PDF untuk Starlink
        $pdf = PDF::loadView('admin.inventory.starlink.pdf_view', compact('datas'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan_starlink.pdf');
    }
}