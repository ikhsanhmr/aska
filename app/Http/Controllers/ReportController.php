<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\MasterData\Unit;  
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\computers;
use App\Exports\laptops;
use App\Exports\monitors;
use App\Exports\network_devices;
use App\Exports\printers;
use App\Exports\servers;
use App\Models\Admin\Inventory\Computer;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportController extends Controller implements FromCollection
{
    
    private $unit; 
    
    public function __construct(Unit $unit)
    {
        $this->unit = $unit; 
    }
    public function index(){
        return view('admin.report.index', ['datas' => $this->unit->getAllData()]);
    }
    
    public function exportPDF(Request $request)
    {
        
        $jenis = $request->query('jenis');
        $unit_id = $request->query('unit_id');
        $status = $request->query('status');

        if ($jenis === null) {
            return redirect()->route('reports.index')->with('error', 'Jenis perangkat belum dipilih');
        }

        $query = DB::table($jenis);
        
        if ($unit_id !== null) {
            $query->where('unit_id', $unit_id);
        }
        
        if ($status !== null) {
            $query->where('ownership_status', $status);
        }

        $query->select($jenis.'.*', 'master_unit.nama_unit', 'device_brands.name as brand_name')
        ->join('master_unit', $jenis.'.unit_id', '=', 'master_unit.id')
        ->join('device_brands', $jenis.'.brand_id', '=', 'device_brands.id');

        if ($jenis == 'network_devices') {
            $query->addSelect('master_vendor.name as vendor_name')
            ->leftJoin('master_vendor', 'network_devices.vendor_id', '=', 'master_vendor.id');
        }

        $results = $query->get();
        
        $results = [
            'results' => $results, 
        ];
        
        
        $namaFileBlade = 'admin.report.pdf.'.$jenis;
        
        $pdf = PDF::loadView($namaFileBlade, compact('results'))
        ->setPaper('a4', 'portrait');
        
        return $pdf->download('data_' . $jenis . '.pdf');
        
        
    }

    public function collection()
    {
        return Computer::all();
    }
    
    public function exportxls(Request $request){
        
        $jenis = $request->query('jenis');
        $unit_id = $request->query('unit_id');
        $status = $request->query('status');
        
        switch ($jenis) {
        case 'computers':
            return Excel::download(new computers($jenis, $unit_id, $status), 'computers.xlsx');
            break;
        case 'laptops':
            return Excel::download(new laptops($jenis, $unit_id, $status), 'laptops.xlsx');
            break;
        case 'monitors':
            return Excel::download(new monitors($jenis, $unit_id, $status), 'monitors.xlsx');
            break;
        case 'network_devices':
            return Excel::download(new network_devices($jenis, $unit_id, $status), 'network_devices.xlsx');
            break;
        case 'printers':
            return Excel::download(new printers($jenis, $unit_id, $status), 'printers.xlsx');
            break;
        case 'servers':
            return Excel::download(new servers($jenis, $unit_id, $status), 'servers.xlsx');
            break;
        default:
            return redirect()->route('reports.index')->with('error', 'Jenis perangkat belum dipilih');
            break;
        }
    }
}
