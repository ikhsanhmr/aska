<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeviceBrandRequest;
use App\Http\Requests\UpdateDeviceBrandRequest;
use App\Models\Admin\MasterData\DeviceBrand;
use Illuminate\Http\Request;

class DeviceBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $deviceBrand;

    public function __construct(DeviceBrand $deviceBrand)
    {
        $this->deviceBrand = $deviceBrand;
    }
    public function index()
    {
        return view('admin.master_data.device_brand.index', ['data' => $this->deviceBrand->getAllData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.device_brand.create', ['data' => $this->deviceBrand->getAllData()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceBrandRequest $request)
    {
        try {
            $this->deviceBrand->create($request->validated());
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Data Gagal Ditambahkan');
        }
        return redirect()->route('device-brand.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceBrand $deviceBrand)
    {
        return view('admin.master_data.device_brand.edit', ['deviceBrand' => $deviceBrand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceBrandRequest $request, DeviceBrand $deviceBrand)
    {
        try {
            $deviceBrand->update($request->validated());
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Data Gagal Diubah');
        }
        return redirect()->route('device-brand.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceBrand $deviceBrand)
    {
        $deviceBrand->delete();
        return redirect()->route('device-brand.index')->with('success', 'Data Berhasil Dihapus');
    }
}
