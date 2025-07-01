<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceStockRequest;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\DeviceStock;

class DeviceStockController extends Controller
{

    private $device_stock;
    private $brands;
    public function __construct(DeviceStock $device_stock, DeviceBrand $brands)
    {
        $this->device_stock = $device_stock;
        $this->brands = $brands;
    }

    public function index()
    {
        return view('admin.master_data.device_stock.index', ['dat' => $this->device_stock->getAllData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.device_stock.create', [
            'device_stock' => $this->device_stock->getAllData(),
            'brands' => $this->brands->getAllCategory(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceStockRequest $request)
    {
        try {
            $this->device_stock->create($request->validated());
            return redirect()->route('device_stock.index')->with('success', 'Berhasil tambah stok perangkat');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal tambah stok perangkat');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceStock $device_stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceStock $device_stock)
    {
        $existingOptions = DeviceStock::where('id', $device_stock->id)->pluck('device_type')->toArray();;

        $options = [
            'Laptop',
            'PC / komputer',
            'Monitor',
            'Printer',
            'Aplikasi Lokal',
            'Server',
            'Network Device',
        ];
        // Menghapus opsi yang sudah ada di database dari opsi dropdown
        $options = array_diff($options, $existingOptions);
        return view('admin.master_data.device_stock.edit', [
            'device_stock' => $device_stock,
            'options' => $options,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeviceStockRequest $request, DeviceStock $device_stock)
    {
        try {
            $device_stock->update($request->validated());
            return redirect()->route('device_stock.index')->with('success', 'Berhasil ubah stok perangkat');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal ubah stok perangkat');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceStock $device_stock)
    {
        $device_stock->delete();
        return redirect()->route('device_stock.index')->with('success', 'Berhasil hapus stok perangkat');
    }
}