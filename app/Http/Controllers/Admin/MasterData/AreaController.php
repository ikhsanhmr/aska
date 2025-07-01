<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\MasterData\Area;
use App\Models\Admin\MasterData\Region;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;

class AreaController extends Controller
{
    private $area;
    private $region;
    public function __construct(Area $area, Region $region)
    {
        $this->area = $area;
        $this->region = $region;
    }
    /**
     * Display a listing of the area.  
     */
    public function index()
    {
        return view('admin.master_data.area.index', ['data' => $this->area->getAllData()]);
    }

    /**
     * Show the form for creating a new area.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.master_data.area.create', ['regions' => $this->region->getAllData()]);
    }

    /**
     * Store a newly created area in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaRequest $request)
    {
        try {
            $this->area->create($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal tambah area');
        }
        return redirect()->route('area.index')->with('success', 'Berhasil tambah area');
    }

    /**
     * Show the form for editing the specified area.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        return view('admin.master_data.area.edit', ['area' => $area, 'regions' => $this->region->getAllData()]);
    }

    /**
     * Update the specified area in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        try {
            $area->update($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal ubah area');
        }
        return redirect()->route('area.index')->with('success', 'Berhasil ubah area');
    }

    /**
     * Remove the specified area from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('area.index')->with('success', 'Berhasil hapus area');
    }
}