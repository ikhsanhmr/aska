<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\MotorDinasRequest;
use App\Models\Admin\Inventory\MotorDinas;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Exports\AllMotorDinasExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class MotorDinasController extends Controller
{
    private $motorDinas;
    private $region;
    private $brand;
    public function __construct(MotorDinas $motorDinas, Region $region, DeviceBrand $brand)
    {
        $this->motorDinas = $motorDinas;
        $this->region = $region;
        $this->brand = $brand;
    }

    function index(Request $request)
    {
        $query = $this->motorDinas->newQuery();

        if ($request->filled('kd_region')) {
            $query->where('kd_region', $request->kd_region);
        }

        $datas = $query->with('brand', 'region')->get();

        return view('admin.inventory.motor-dinas.index', ['datas' => $datas, 'regions' => $this->region->getAllData()]);
    }

    public function exportExcel(Request $request)
    {
        $kd_region = $request->query('kd_region');
        return Excel::download(new AllMotorDinasExport($kd_region), 'laporan_motor_dinas.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $kd_region = $request->query('kd_region');

        $query = $this->motorDinas->newQuery();

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->with('brand', 'region')->get();

        $pdf = PDF::loadView('admin.inventory.motor-dinas.pdf_view', compact('datas'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan_motor_dinas.pdf');
    }

    public function create()
    {
        return view('admin.inventory.motor-dinas.create', [
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandMotor()
        ]);
    }


    public function store(MotorDinasRequest $request)
    {
        try {
            // dd($request->validated());
            if ($request->hasfile('bast')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
                $file = $request->file('bast');
                Storage::disk('local')->put('bast/motor-dinas/' . $filename, File::get($file));
                $data = [
                    'brand_id' => $request->brand_id,
                    'kd_region' => $request->kd_region,
                    'nomor_polisi' => $request->nomor_polisi,
                    'nomor_rangka' => $request->nomor_rangka,
                    'nama_pegawai' => $request->nama_pegawai,
                    'nomor_mesin' => $request->nomor_mesin,
                    'model' => $request->model,
                    'tahun_pembuatan' => $request->tahun_pembuatan,
                    'warna' => $request->warna,
                    'status_asset' => $request->status_asset,
                    'bast' => $filename,
                    'keterangan' => $request->keterangan,
                ];
                $this->motorDinas->create($data);
            } else {
                $this->motorDinas->create($request->validated());
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Komputer');
        }
        return redirect()->route('motor-dinas.index')->with('success', 'Berhasil Tambah Data Komputer');
    }


    public function show()
    {
        //
    }


    public function edit(MotorDinas $motor_dina)
    {
        return view('admin.inventory.motor-dinas.edit', [
            'motorDinas' => $motor_dina,
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandMotor()
        ]);
    }


    public function update(MotorDinasRequest $request, MotorDinas $motor_dina)
    {
        if ($request->hasfile('bast')) {

            if (!empty($motor_dina->bast)) {
                Storage::disk('local')->delete('bast/motor-dinas/' . $motor_dina->bast);
            }

            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
            $file = $request->bast;
            Storage::disk('local')->put('bast/motor-dinas/' . $filename, File::get($file));

            $data = [
                'brand_id' => $request->brand_id,
                'kd_region' => $request->kd_region,
                'nomor_polisi' => $request->nomor_polisi,
                'nomor_rangka' => $request->nomor_rangka,
                'nama_pegawai' => $request->nama_pegawai,
                'nomor_mesin' => $request->nomor_mesin,
                'model' => $request->model,
                'tahun_pembuatan' => $request->tahun_pembuatan,
                'warna' => $request->warna,
                'status_asset' => $request->status_asset,
                'bast' => $filename,
                'keterangan' => $request->keterangan,
            ];

            $motor_dina->update($data);
        } else {

            $motor_dina->update($request->validated());
        }

        return redirect()->route('motor-dinas.index')->with('success', 'Berhasil Mengubah Data Motor Dinas');
    }


    public function destroy(MotorDinas $motor_dina)
    {
        if (!empty($motor_dina->bast)) {
            Storage::disk('local')->delete('bast/motor-dinas/' . $motor_dina->bast);
        }
        $motor_dina->delete();
        return redirect()->route('motor-dinas.index')->with('success', 'Berhasil Hapus Data Motor Dinas');
    }
}
