<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Admin\MasterData\Unit;
use App\Models\Admin\MasterData\Region;
use App\Models\Admin\MasterData\Area;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $unit;
    private $area;
    private $region;
    public function __construct(
        Unit $unit,
        Region $region,
        Area $area
    ) {
        $this->area = $area;
        $this->unit = $unit;
        $this->region = $region;
    }

    public function index()
    {
        return view('admin.master_data.unit.index', ['data' => $this->unit->getAllData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.master_data.unit.create', [
            'regions' => $this->region->getAllData(),
            'areas' => $this->area->getAllData()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        try {
            $this->unit->create($request->validated());
        } catch (\Exception $e) {
            return redirect(route('unit.index'))->with('error', 'Gagal Tambah Data');
        }
        return redirect(route('unit.index'))->with('success', 'Berhasil Tambah Data');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('admin.master_data.unit.edit', [
            'unit' => $unit,
            'regions' => $this->region->getAllData(),
            'areas' => $this->area->getAllData(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        try {
            $unit->update($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal ubah unit');
        }
        return redirect()->route('unit.index')->with('success', 'Berhasil ubah unit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('unit.index')->with('success', 'Berhasil hapus unit');
    }
}
