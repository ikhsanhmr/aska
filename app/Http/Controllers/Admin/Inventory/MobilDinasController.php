<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\MobilDinasRequest;
use App\Models\Admin\Inventory\MobilDinas;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MobilDinasController extends Controller
{
    private $mobilDinas;
    private $region;
    private $brand;
    public function __construct(MobilDinas $mobilDinas, Region $region, DeviceBrand $brand)
    {
        $this->mobilDinas = $mobilDinas;
        $this->region = $region;
        $this->brand = $brand;
    }

    function index()
    {
        return view('admin.inventory.mobil-dinas.index', ['datas' => $this->mobilDinas->getAllData()]);
    }

    public function create()
    {
        return view('admin.inventory.mobil-dinas.create', [
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandMobil()
        ]);
    }


    public function store(MobilDinasRequest $request)
    {
        try {
            // dd($request->validated());
            if ($request->hasfile('bast')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
                $file = $request->file('bast');
                Storage::disk('local')->put('bast/mobil-dinas/' . $filename, File::get($file));
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
                $this->mobilDinas->create($data);
            } else {
                $this->mobilDinas->create($request->validated());
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Komputer');
        }
        return redirect()->route('mobil-dinas.index')->with('success', 'Berhasil Tambah Data Komputer');
    }


    public function show()
    {
        //
    }


    public function edit(MobilDinas $mobil_dina)
    {
        return view('admin.inventory.mobil-dinas.edit', [
            'mobilDinas' => $mobil_dina,
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandMobil()
        ]);
    }


    public function update(MobilDinasRequest $request, MobilDinas $mobil_dina)
    {
        if ($request->hasfile('bast')) {

            if (!empty($mobil_dina->bast)) {
                Storage::disk('local')->delete('bast/mobil-dinas/' . $mobil_dina->bast);
            }

            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
            $file = $request->bast;
            Storage::disk('local')->put('bast/mobil-dinas/' . $filename, File::get($file));

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

            $mobil_dina->update($data);
        } else {

            $mobil_dina->update($request->validated());
        }

        return redirect()->route('mobil-dinas.index')->with('success', 'Berhasil Mengubah Data Mobil Dinas');
    }


    public function destroy(MobilDinas $mobil_dina)
    {
        if (!empty($mobil_dina->bast)) {
            Storage::disk('local')->delete('bast/mobil-dinas/' . $mobil_dina->bast);
        }
        $mobil_dina->delete();
        return redirect()->route('mobil-dinas.index')->with('success', 'Berhasil Hapus Data Mobil Dinas');
    }
}
