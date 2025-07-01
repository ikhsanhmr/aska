<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendorRequest;
use Illuminate\Http\Request;
use App\Models\Admin\MasterData\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $vendor;
    public function  __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function index()
    {
        return view('admin.master_data.vendor.index', ['data' => $this->vendor->getAllData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.vendor.create', ['data' => $this->vendor->getAllData()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        try {
            $this->vendor->create($request->validated());
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Data Gagal Ditambahkan');
        }
        return redirect()->route('vendor.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Vendor $vendor)
    {

        return view('admin.master_data.vendor.edit', ['vendor' => $vendor]);
    }
    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreVendorRequest $request, Vendor $vendor)
    {
        // dd($request->all());
        try {
            $vendor->update($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data Gagal Diubah');
        }
        return redirect()->route('vendor.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendor.index')->with('success', 'Data berhasil Dihapus');
    }
}