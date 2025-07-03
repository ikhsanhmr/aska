<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\StarlinkRequest;
use App\Models\Admin\Inventory\Starlink;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use Illuminate\Http\Request;

class StarlinkController extends Controller
{
    private $starlink;
    private $region;
    private $brand;
    public function __construct(Starlink $starlink, Region $region, DeviceBrand $brand)
    {
        $this->starlink = $starlink;
        $this->region = $region;
        $this->brand = $brand;
    }

    public function index(Request $request)
    {
        $kd_region = $request->query('kd_region');
        
        $query = Starlink::with('region');

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }
        
        $datas = $query->latest()->get();
        
        // Ambil semua data region untuk dropdown filter
        $regions = Region::all();

        return view('admin.inventory.starlink.index', compact('datas', 'regions'));
    }

    public function create()
    {
        return view('admin.inventory.starlink.create', [
            'regions' => $this->region->getAllData(),
        ]);
    }


    public function store(StarlinkRequest $request)
    {
        try {
            $this->starlink->create($request->validated());
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Starlink');
        }
        return redirect()->route('starlink.index')->with('success', 'Berhasil Tambah Data Starlink');
    }


    public function show()
    {
        //
    }


    public function edit(Starlink $starlink)
    {
        return view('admin.inventory.starlink.edit', [
            'starlink' => $starlink,
            'regions' => $this->region->getAllData(),
        ]);
    }


    public function update(StarlinkRequest $request, Starlink $starlink)
    {
        $starlink->update($request->validated());
        return redirect()->route('starlink.index')->with('success', 'Berhasil Mengubah Data Starlink');
    }


    public function destroy(Starlink $starlink)
    {
        $starlink->delete();
        return redirect()->route('starlink.index')->with('success', 'Berhasil Hapus Data Starlink');
    }
}
