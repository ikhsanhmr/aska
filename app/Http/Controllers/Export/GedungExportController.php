<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\Gedung; // Sesuaikan namespace
use App\Exports\AllGedungsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class GedungExportController extends Controller
{
    /**
     * Menangani permintaan untuk mengekspor data Gedung ke file Excel.
     */
    public function exportExcel(Request $request)
    {
        $kd_region = $request->query('kd_region');
        return Excel::download(new AllGedungsExport($kd_region), 'laporan_gedung.xlsx');
    }

    /**
     * Menangani permintaan untuk mengekspor data Gedung ke file PDF.
     */
    public function exportPdf(Request $request)
    {
        $kd_region = $request->query('kd_region');

        $query = Gedung::with('region');

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->get();

        $pdf = PDF::loadView('admin.inventory.gedung.pdf_view', compact('datas'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan_gedung.pdf');
    }
}