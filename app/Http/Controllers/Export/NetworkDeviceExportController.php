<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\NetworkDevice; // Sesuaikan namespace
use App\Exports\AllNetworkDevicesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class NetworkDeviceExportController extends Controller
{
    /**
     * Menangani permintaan untuk mengekspor data ke file Excel.
     */
    public function exportExcel(Request $request)
    {
        $kd_region = $request->query('kd_region');
        return Excel::download(new AllNetworkDevicesExport($kd_region), 'laporan_network_device.xlsx');
    }

    /**
     * Menangani permintaan untuk mengekspor data ke file PDF.
     */
    public function exportPdf(Request $request)
    {
        $kd_region = $request->query('kd_region');

        $query = NetworkDevice::with('getDeviceBrands', 'getUnits', 'getVendor', 'region');

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->get();

        $pdf = PDF::loadView('admin.inventory.network_device.pdf_view', compact('datas'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan_network_device.pdf');
    }
}