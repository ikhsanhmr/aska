<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Models\Admin\MasterData\NetworkInterferenceCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NetworkInterferenceCategoryRequest;

class NetworkInterferenceCategoryController extends Controller
{
    private $networkinterferce; 
    public function __construct(NetworkInterferenceCategory $networkinterferce)
    {
        $this->networkinterferce = $networkinterferce; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master_data.network_interference_category.index', ['datas' => $this->networkinterferce->getAllData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.network_interference_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NetworkInterferenceCategoryRequest $request)
    {
        try {
            $this->networkinterferce->create($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal tambah data');
        }
        return redirect()->route('networkinterference.index')->with('success', 'Berhasil tambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(NetworkInterferenceCategory $networkInterferenceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NetworkInterferenceCategory $networkinterference)
    {
        return view('admin.master_data.network_interference_category.edit', ['networkinterference' => $networkinterference]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NetworkInterferenceCategoryRequest $request, NetworkInterferenceCategory $networkinterference)
    {
        try {
            $networkinterference->update($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal ubah data');
        }
        return redirect()->route('networkinterference.index')->with('success', 'Berhasil ubah data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NetworkInterferenceCategory $networkinterference)
    {
        $networkinterference->delete();
        return redirect()->route('networkinterference.index')->with('success', 'Berhasil hapus data');

    }
}
