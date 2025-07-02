<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\Printer;
use App\Exports\AllPrintersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PrinterExportController extends Controller
{
    /**
     * Menangani permintaan untuk mengekspor data printer ke file Excel.
     */
    public function exportExcel(Request $request)
    {
        $kd_region = $request->query('kd_region');

        return Excel::download(new AllPrintersExport($kd_region), 'laporan_printer.xlsx');
    }

    /**
     * Menangani permintaan untuk mengekspor data printer ke file PDF.
     */
    public function exportPdf(Request $request)
    {
        $kd_region = $request->query('kd_region');

        $query = Printer::with('getDeviceBrands', 'region');

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->get();

        $pdf = PDF::loadView('admin.inventory.printers.pdf_view', compact('datas'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan_printer.pdf');
    }
}
