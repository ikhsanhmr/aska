<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Models\Admin\MasterData\DeviceInterferenceCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceInterferenceCategoryRequest;


class DeviceInterferenceCategoryController extends Controller
{
    private $deviceinterference; 
    public function __construct(DeviceInterferenceCategory $deviceinterference)
    {
        $this->deviceinterference = $deviceinterference; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master_data.device_interference_category.index', ['datas' => $this->deviceinterference->getAllData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.device_interference_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceInterferenceCategoryRequest $request)
    {
        try {
            $this->deviceinterference->create($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal tambah data');
        }
        return redirect()->route('deviceinterference.index')->with('success', 'Berhasil tambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceInterferenceCategory $deviceinterference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceInterferenceCategory $deviceinterference)
{
    return view('admin.master_data.device_interference_category.edit', ['deviceinterference' => $deviceinterference]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(DeviceInterferenceCategoryRequest $request, DeviceInterferenceCategory $deviceinterference)
    {
        try {
            $deviceinterference->update($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal ubah data');
        }
        return redirect()->route('deviceinterference.index')->with('success', 'Berhasil ubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceInterferenceCategory $deviceinterference)
    {
        $deviceinterference->delete();
        return redirect()->route('deviceinterference.index')->with('success', 'Berhasil hapus data');
    }
}
