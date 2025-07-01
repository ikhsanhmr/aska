<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\MasterData\NetworkContractIcon;
use App\Http\Requests\NetworkContractIconRequest;
use App\Models\Admin\MasterData\Unit;


class NetworkContractIconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $network_contract_icon;
    private $unit;
    public function __construct(NetworkContractIcon $network_contract_icon, Unit $unit)
    {
        $this->network_contract_icon = $network_contract_icon;
        $this->unit = $unit;
    }
    public function index()
    {
        return view('admin.master_data.network_contract_icon.index', ['datas' => $this->network_contract_icon->getAllData()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.network_contract_icon.create', [
            'units' => $this->unit->getAllData(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NetworkContractIconRequest $request)
    {
        try {
            $this->network_contract_icon->create($request->validated());
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error',$e->getMessage());
        }
        return redirect()
            ->route('network-contract-icon.index')
            ->with('success', 'Berhasil tambah kontrak jaringan icon+');
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
    public function edit(NetworkContractIcon $network_contract_icon)
    {
        return view('admin.master_data.network_contract_icon.edit', [
            'network_contract_icon' => $network_contract_icon,
            'units' => $this->unit->getAllData(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NetworkContractIconRequest $request, NetworkContractIcon $network_contract_icon)
    {
        try {
            $network_contract_icon->update($request->validated());
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal ubah kontrak jaringan icon+');
        }
        return redirect()
            ->route('network-contract-icon.index')
            ->with('success', 'Berhasil ubah kontrak jaringan icon+');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NetworkContractIcon $network_contract_icon)
    {
        $network_contract_icon->delete();
        return redirect()
            ->route('network-contract-icon.index')
            ->with('success', 'Berhasil hapus kontrak jaringan icon+');
    }
}
