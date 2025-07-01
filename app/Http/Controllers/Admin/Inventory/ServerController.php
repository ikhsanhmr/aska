<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServerRequest;
use App\Models\Admin\MasterData\Unit;
use App\Models\Admin\Inventory\Server;
use App\Models\Admin\MasterData\DeviceBrand;

class ServerController extends Controller
{
    private $server;
    private $unit;
    private $brand;
    public function __construct(Server $server, Unit $unit, DeviceBrand $brand)
    {
        $this->server = $server;
        $this->unit = $unit;
        $this->brand = $brand;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.inventory.servers.index', ['datas' => $this->server->getAllData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inventory.servers.create', [
            'brands' => $this->brand->getBrandServers(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServerRequest $request)
    {
        try {
            $this->server->create($request->validated());
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal tambah server');
        }
        return redirect()
            ->route('servers.index')
            ->with('success', 'Berhasil tambah server');
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
    public function edit(Server $server)
    {
        return view('admin.inventory.servers.edit', [
            'server' => $server,
            'brands' => $this->brand->getBrandServers(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServerRequest $request, Server $server)
    {
        try {
            $server->update($request->validated());
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal ubah server');
        }
        return redirect()
            ->route('servers.index')
            ->with('success', 'Berhasil ubah server');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Server $server)
    {
        $server->delete();
        return redirect()
            ->route('servers.index')
            ->with('success', 'Berhasil hapus server');
    }
}
