<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Exports\AllAccessPointsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Models\Admin\Inventory\AccessPoint;

class AccessPointExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $kd_region = $request->query('kd_region');

        return Excel::download(new AllAccessPointsExport($kd_region), 'laporan_access_point.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $kd_region = $request->query('kd_region');

        $query = AccessPoint::with('region');

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->get();

        $pdf = PDF::loadView('admin.inventory.access-point.pdf_view', compact('datas'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan_access_point.pdf');
    }
}
