<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccessPointRequest;
use App\Models\Admin\Inventory\AccessPoint;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccessPointController extends Controller
{
    private $accessPoint;
    private $region;
    private $brand;
    public function __construct(AccessPoint $accessPoint, Region $region, DeviceBrand $brand)
    {
        $this->accessPoint = $accessPoint;
        $this->region = $region;
        $this->brand = $brand;
    }

    function index()
    {
        return view('admin.inventory.access-point.index', ['datas' => $this->accessPoint->getAllData()]);
    }

    public function create()
    {
        return view('admin.inventory.access-point.create', [
            'regions' => $this->region->getAllData(),
        ]);
    }


    public function store(AccessPointRequest $request)
    {
        try {
            $this->accessPoint->create($request->validated());
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data access point');
        }
        return redirect()->route('access-point.index')->with('success', 'Berhasil Tambah Data access point');
    }


    public function show()
    {
        //
    }


    public function edit(AccessPoint $access_point)
    {
        return view('admin.inventory.access-point.edit', [
            'accessPoint' => $access_point,
            'regions' => $this->region->getAllData(),
        ]);
    }


    public function update(AccessPointRequest $request, AccessPoint $access_point)
    {
        $access_point->update($request->validated());

        return redirect()->route('access-point.index')->with('success', 'Berhasil Mengubah Data access point');
    }


    public function destroy(AccessPoint $access_point)
    {
        $access_point->delete();
        return redirect()->route('access-point.index')->with('success', 'Berhasil Hapus Data access point');
    }
}
