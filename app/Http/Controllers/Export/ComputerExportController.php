<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\Computer;
use App\Exports\computers;
use App\Exports\AllComputersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ComputerExportController extends Controller
{
    /**
     * Menangani permintaan untuk mengekspor data komputer ke file Excel.
     */
    public function exportExcel(Request $request)
    {
        $kd_region = $request->query('kd_region');
        return Excel::download(new AllComputersExport($kd_region), 'laporan_komputer.xlsx');
    }

    /**
     * Menangani permintaan untuk mengekspor data komputer ke file PDF.
     */
    public function exportPdf(Request $request)
    {
        $kd_region = $request->query('kd_region');

        $query = Computer::with('getDeviceBrands', 'getVendor', 'region');

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->get();

        $pdf = PDF::loadView('admin.inventory.computers.pdf_view', compact('datas'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan_komputer.pdf');
    }
}
