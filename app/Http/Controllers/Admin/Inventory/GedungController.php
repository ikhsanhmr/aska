<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\GedungRequest;
use App\Models\Admin\Inventory\Gedung;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GedungController extends Controller
{
    private $gedung;
    private $region;
    private $brand;
    public function __construct(Gedung $gedung, Region $region, DeviceBrand $brand)
    {
        $this->gedung = $gedung;
        $this->region = $region;
        $this->brand = $brand;
    }

    public function index(Request $request)
    {
        $kd_region = $request->query('kd_region');
        
        $query = Gedung::with('region');

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }
        
        $datas = $query->latest()->get();
        
        // Ambil semua data region untuk dropdown filter
        $regions = Region::all();

        return view('admin.inventory.gedung.index', compact('datas', 'regions'));
    }

    public function create()
    {
        return view('admin.inventory.gedung.create', [
            'regions' => $this->region->getAllData(),
        ]);
    }


    public function store(GedungRequest $request)
    {
        try {
            // dd($request->validated());
            if ($request->hasfile('bast')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
                $file = $request->file('bast');
                Storage::disk('local')->put('bast/gedung/' . $filename, File::get($file));
                $data = [
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'kd_region' => $request->kd_region,
                    'status_asset' => $request->status_asset,
                    'keterangan' => $request->keterangan,
                    'bast' => $filename
                ];
                $this->gedung->create($data);
            } else {
                $this->gedung->create($request->validated());
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Gedung');
        }
        return redirect()->route('gedung.index')->with('success', 'Berhasil Tambah Data Gedung');
    }


    public function show()
    {
        //
    }


    public function edit(Gedung $gedung)
    {
        return view('admin.inventory.gedung.edit', [
            'gedung' => $gedung,
            'regions' => $this->region->getAllData(),
        ]);
    }


    public function update(GedungRequest $request, Gedung $gedung)
    {
        if ($request->hasfile('bast')) {

            if (!empty($gedung->bast)) {
                Storage::disk('local')->delete('bast/gedung/' . $gedung->bast);
            }

            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
            $file = $request->bast;
            Storage::disk('local')->put('bast/gedung/' . $filename, File::get($file));

            $data = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'kd_region' => $request->kd_region,
                'status_asset' => $request->status_asset,
                'keterangan' => $request->keterangan,
                'bast' => $filename
            ];

            $gedung->update($data);
        } else {

            $gedung->update($request->validated());
        }

        return redirect()->route('gedung.index')->with('success', 'Berhasil Mengubah Data gedung');
    }


    public function destroy(Gedung $gedung)
    {
        if (!empty($gedung->bast)) {
            Storage::disk('local')->delete('bast/gedung/' . $gedung->bast);
        }
        $gedung->delete();
        return redirect()->route('gedung.index')->with('success', 'Berhasil Hapus Data gedung');
    }
}
