<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Admin\MasterData\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    private $region;
    public function __construct(Region $region)
    {
        $this->region = $region;
    }

    public function index()
    {
        return view('admin.master_data.region.index', ['data' => $this->region->getAllData()]);
    }

    public function create()
    {
        return view('admin.master_data.region.create');
    }

    public function store(StoreRegionRequest $request)
    {
        try {
            $this->region->create($request->validated());
        } catch (\Exception $e) {
            return redirect(route('region.index'))->with('error', 'Gagal Tambah Data');
        }
        return redirect(route('region.index'))->with('success', 'Berhasil Tambah Data');
    }

    public function edit(Region $region)
    {
        return view('admin.master_data.region.edit', compact('region'));
    }

    public function update(UpdateRegionRequest $request, Region $region)
    {
        try {
            $region->update($request->validated());
        } catch (\Exception $e) {
            return redirect(route('region.index'))->with('error', 'Gagal Update Data');
        }
        return redirect(route('region.index'))->with('success', 'Berhasil Update Data');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect(route('region.index'))->with('success', 'Berhasil Hapus Data');
    }
}
