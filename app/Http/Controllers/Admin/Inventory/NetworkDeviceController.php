<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NetworkDeviceRequest;
use App\Models\Admin\MasterData\Unit;
use App\Models\Admin\Inventory\NetworkDevice;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Vendor;
use App\Models\Admin\MasterData\Region; // <-- GUNAKAN BARIS INI

class NetworkDeviceController extends Controller
{
    private $network_device;
    private $vendor;
    private $unit;
    private $brand;
    public function __construct(NetworkDevice $network_device, Vendor $vendor, Unit $unit, DeviceBrand $brand)
    {
        $this->network_device = $network_device;
        $this->vendor = $vendor;
        $this->unit = $unit;
        $this->brand = $brand;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kd_region = $request->query('kd_region');
        
        // Sesuaikan nama relasi dengan yang ada di model
        $query = NetworkDevice::with('getDeviceBrands', 'getUnits', 'getVendor', 'region');

        if ($kd_region) {
            // Asumsi tabel network_device punya kolom kd_region
            $query->where('kd_region', $kd_region);
        }
        
        $datas = $query->latest()->get();
        
        // Ambil semua data region untuk dropdown filter
        $regions = Region::all();

        return view('admin.inventory.network_device.index', compact('datas', 'regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inventory.network_device.create', [
            'units' => $this->unit->getAllData(),
            'vendors' => $this->vendor->getAllData(),
            'brands' => $this->brand->getBrandNetworkDevices(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NetworkDeviceRequest $request)
    {
        try {
            $validatedData = $request->validated();

            if ($validatedData['ownership_status'] === 'Aset PLN') {
                $validatedData['vendor_id'] = null;
            }
            $this->network_device->create($validatedData);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal tambah network device');
        }
        return redirect()
            ->route('network-devices.index')
            ->with('success', 'Berhasil tambah network device');
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
    public function edit(NetworkDevice $network_device)
    {
        return view('admin.inventory.network_device.edit', [
            'network_device' => $network_device,
            'vendors' => $this->vendor->getAllData(),
            'units' => $this->unit->getAllData(),
            'brands' => $this->brand->getBrandNetworkDevices(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NetworkDeviceRequest $request, NetworkDevice $network_device)
    {
        try {
            $validatedData = $request->validated();

            if ($validatedData['ownership_status'] === 'Aset PLN') {
                $validatedData['vendor_id'] = null;
            }
            $network_device->update($validatedData);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal ubah network device');
        }
        return redirect()
            ->route('network-devices.index')
            ->with('success', 'Berhasil ubah network device');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NetworkDevice $network_device)
    {
        $network_device->delete();
        return redirect()
            ->route('network-devices.index')
            ->with('success', 'Berhasil hapus network device');
    }
}
