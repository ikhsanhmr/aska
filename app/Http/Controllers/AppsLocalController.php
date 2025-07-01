<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\MasterData\Unit;
use App\Models\AppsLocal;
use App\Http\Requests\AppsLocalRequest;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Admin\MasterData\Area;

class AppsLocalController extends Controller
{
    private $Unit;
    private $Appslocal;
    public function __construct(Unit $Unit, Appslocal $Appslocal)
    {
        $this->Appslocal = $Appslocal;
        $this->Unit = $Unit;
    }

    public function index()
    {
        return view('admin.inventory.appslocal.index', ['dat' => $this->Appslocal->getAllData()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inventory.appslocal.create', [
            'appslocal' => $this->Appslocal->getAllData(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppsLocalRequest $request)
    {
        try {
            $this->Appslocal->create($request->validated());
            return redirect()->route('appslocal.index')->with('success', 'Berhasil tambah apps local');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal tambah apps local');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Appslocal $Appslocal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appslocal $Appslocal)
    {
        return view('admin.inventory.appslocal.edit', [
            'appslocal' => $Appslocal,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppsLocalRequest $request, Appslocal $Appslocal)
    {
        try {
            $Appslocal->update($request->validated());
            return redirect()->route('appslocal.index')->with('success', 'Berhasil ubah apps local');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal ubah apps local');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appslocal $Appslocal)
    {
        $Appslocal->delete();
        return redirect()->route('appslocal.index')->with('success', 'Berhasil hapus apps local');
    }
}
