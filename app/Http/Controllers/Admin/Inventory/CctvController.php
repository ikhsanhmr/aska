<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\CctvRequest;
use App\Models\Admin\Inventory\Cctv;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CctvController extends Controller
{
    private $cctv;
    private $region;
    private $brand;
    public function __construct(Cctv $cctv, Region $region, DeviceBrand $brand)
    {
        $this->cctv = $cctv;
        $this->region = $region;
        $this->brand = $brand;
    }

    public function index(Request $request)
{
    // BENAR: Panggil relasi 'brand' dan 'region' yang sesuai dengan definisi di model Cctv.php
    // Relasi 'getVendor' dihapus karena CCTV tidak memilikinya.
    $query = Cctv::with('brand', 'region');

    if ($request->filled('kd_region')) {
        $query->where('kd_region', $request->kd_region);
    }

    $datas = $query->get();
    
    // Asumsi $this->region->getAllData() berfungsi, jika tidak, gunakan Region::all()
    $regions = Region::all(); 

    return view('admin.inventory.cctv.index', compact('datas', 'regions'));
}

    public function create()
    {
        return view('admin.inventory.cctv.create', [
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandCctv()
        ]);
    }


    public function store(CctvRequest $request)
    {
        try {
            $this->cctv->create($request->validated());
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data CCTV');
        }
        return redirect()->route('cctv.index')->with('success', 'Berhasil Tambah Data CCTV');
    }


    public function show()
    {
        //
    }


    public function edit(Cctv $cctv)
    {
        return view('admin.inventory.cctv.edit', [
            'cctv' => $cctv,
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandCctv()
        ]);
    }


    public function update(CctvRequest $request, Cctv $cctv)
    {
        $cctv->update($request->validated());
        return redirect()->route('cctv.index')->with('success', 'Berhasil Mengubah Data Cctv');
    }


    public function destroy(Cctv $cctv)
    {
        $cctv->delete();
        return redirect()->route('cctv.index')->with('success', 'Berhasil Hapus Data Cctv');
    }
}
