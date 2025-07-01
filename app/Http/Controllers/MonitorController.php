<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonitorRequest;
use App\Models\Monitor;
use Illuminate\Http\Request;
use App\Models\Admin\MasterData\Region;
use App\Models\Admin\MasterData\Vendor;
use App\Models\Admin\MasterData\DeviceBrand;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $monitor;
    private $vendor;
    private $region;
    private $brand;
    public function __construct(Monitor $monitor, Vendor $vendor, Region $region, DeviceBrand $brand)
    {
        $this->monitor  = $monitor;
        $this->vendor = $vendor;
        $this->region = $region;
        $this->brand = $brand;
    }

    public function index()
    {
        return view('admin.inventory.monitors.index',  ['datas' => $this->monitor->getAllData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inventory.monitors.create', [
            'vendors' => $this->vendor->getAllData(),
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandMonitors()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MonitorRequest $request)
    {
        try {
            $this->monitor->create($request->validated());
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Monitor');
        }
        return redirect()->route('monitors.index')->with('success', 'Berhasil Tambah Data Monitor');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Monitor $monitor)
    {
        return view('admin.inventory.monitors.edit', [
            'monitor' => $monitor,
            'vendors' => $this->vendor->getAllData(),
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandMonitors()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Monitor $monitor, MonitorRequest $request)
    {
        try {
            $monitor->update($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal Mengubah Data Monitor');
        }
        return redirect()->route('monitors.index')->with('success', 'Berhasil Mengubah Data Monitor');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitor $monitor)
    {
        $monitor->delete();
        return redirect()->route('monitors.index')->with('success', 'Berhasil Hapus Data Monitor');
    }
}
