<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrinterRequest;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use App\Models\Admin\MasterData\Vendor;
use App\Models\Admin\Inventory\Printer;

class PrinterController extends Controller
{
    private $printer;
    private $vendor;
    private $region;
    private $brand;

    public function __construct(Printer $printer, Vendor $vendor, Region $region, DeviceBrand $brand)
    {
        $this->printer = $printer;
        $this->vendor = $vendor;
        $this->region = $region;
        $this->brand = $brand;
    }

    // public function index()
    // {
    //     return view('admin.inventory.printers.index',  ['datas' => $this->printer->getAllData()]);
    // }
    public function index()
    {
        $kd_region = request()->query('kd_region');

        $query = $this->printer->with(['getDeviceBrands', 'getUnits', 'getVendor', 'region'])->latest();

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->get();

        return view('admin.inventory.printers.index', [
            'datas' => $datas,
            'regions' => $this->region->getAllData()
        ]);
    }

    public function create()
    {
        return view('admin.inventory.printers.create', [
            'vendors' => $this->vendor->getAllData(),
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandPrinters()
        ]);
    }

    public function store(PrinterRequest $request)
    {
        try {
            $this->printer->create($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Printer');
        }
        return redirect()->route('printers.index')->with('success', 'Berhasil Tambah Data Printer');
    }

    public function edit(Printer $printer)
    {
        return view('admin.inventory.printers.edit', [
            'printer' => $printer,
            'vendors' => $this->vendor->getAllData(),
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandPrinters()
        ]);
    }

    public function update(PrinterRequest $request, Printer $printer)
    {
        try {
            $printer->update($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal Mengubah Data Printer');
        }
        return redirect()->route('printers.index')->with('success', 'Berhasil Mengubah Data Printer');
    }

    public function destroy(Printer $printer)
    {
        $printer->delete();
        return redirect()->route('printers.index')->with('success', 'Berhasil Hapus Data Printer');
    }
}
