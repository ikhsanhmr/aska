<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\HandphoneRequest;
use App\Models\Admin\Inventory\Handphone;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HandphoneController extends Controller
{
    private $handphone;
    private $region;
    private $brand;
    public function __construct(Handphone $handphone, Region $region, DeviceBrand $brand)
    {
        $this->handphone = $handphone;
        $this->region = $region;
        $this->brand = $brand;
    }

    function index() {
        return view('admin.inventory.handphone.index', ['datas' => $this->handphone->getAllData()]);
    }

    public function create()
    {
        return view('admin.inventory.handphone.create', [
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandHandphone()
        ]);
    }


    public function store(HandphoneRequest $request)
    {
        try {
            // dd($request->validated());
            if ($request->hasfile('bast')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
                $file = $request->file('bast');
                Storage::disk('local')->put('bast/handphone/' . $filename, File::get($file));
                $data = [
                    'serial_number' => $request->serial_number,
                    'brand_id' => $request->brand_id,
                    'model' => $request->model,
                    'nama_pegawai' => $request->nama_pegawai,
                    'kd_region' => $request->kd_region,
                    'status_asset' => $request->status_asset,
                    'keterangan' => $request->keterangan,
                    'bast' => $filename
                ];
                $this->handphone->create($data);
            } else {
                $this->handphone->create($request->validated());
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Komputer');
        }
        return redirect()->route('handphone.index')->with('success', 'Berhasil Tambah Data Komputer');
    }


    public function show()
    {
        //
    }


    public function edit(Handphone $handphone)
    {
        return view('admin.inventory.handphone.edit', [
            'handphone' => $handphone,
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandHandphone()
        ]);
    }


    public function update(HandphoneRequest $request, Handphone $handphone)
    {
        if ($request->hasfile('bast')) {

            if (!empty($handphone->bast)) {
                Storage::disk('local')->delete('bast/handphone/' . $handphone->bast);
            }

            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
            $file = $request->bast;
            Storage::disk('local')->put('bast/handphone/' . $filename, File::get($file));

            $data = [
                'serial_number' => $request->serial_number,
                'brand_id' => $request->brand_id,
                'model' => $request->model,
                'nama_pegawai' => $request->nama_pegawai,
                'kd_region' => $request->kd_region,
                'status_asset' => $request->status_asset,
                'status_id' => $request->status_id,
                'keterangan' => $request->keterangan,
                'bast' => $filename
            ];

            $handphone->update($data);
        } else {

            $handphone->update($request->validated());
        }

        return redirect()->route('handphone.index')->with('success', 'Berhasil Mengubah Data Handphone');
    }


    public function destroy(Handphone $handphone)
    {
        if (!empty($handphone->bast)) {
            Storage::disk('local')->delete('bast/handphone/' . $handphone->bast);
        }
        $handphone->delete();
        return redirect()->route('handphone.index')->with('success', 'Berhasil Hapus Data Handphone');
    }
}
