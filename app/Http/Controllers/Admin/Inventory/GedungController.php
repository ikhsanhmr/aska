<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\GedungRequest; // Assuming this request exists and will be updated by you
use App\Models\Admin\Inventory\Gedung;
use App\Models\Admin\MasterData\DeviceBrand; // Not used in this context, can be removed if not needed elsewhere
use App\Models\Admin\MasterData\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GedungController extends Controller
{
    private $gedung;
    private $region;
    private $brand; // Not used in this context, can be removed if not needed elsewhere

    public function __construct(Gedung $gedung, Region $region, DeviceBrand $brand)
    {
        $this->gedung = $gedung;
        $this->region = $region;
        $this->brand = $brand; // Not used in this context, can be removed if not needed elsewhere
    }

    public function index(Request $request)
    {
        // Change from kd_region to kd_up
        $kd_up = $request->query('kd_up');
        
        $query = Gedung::with('region');

        if ($kd_up) {
            $query->where('kd_up', $kd_up);
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
            $validatedData = $request->validated();

            if ($request->hasfile('bast')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
                $file = $request->file('bast');
                Storage::disk('local')->put('bast/gedung/' . $filename, File::get($file));
                $validatedData['bast'] = $filename;
            } else {
                // If bast is not provided, ensure it's null or handled as per your validation
                $validatedData['bast'] = null;
            }

            // Ensure 'pihak_pertama' and 'status_sewa' are set to 'Sewa' if they are meant to be fixed
            if (!isset($validatedData['pihak_pertama'])) {
                $validatedData['pihak_pertama'] = 'Sewa';
            }
            if (!isset($validatedData['status_sewa'])) {
                $validatedData['status_sewa'] = 'Sewa';
            }

            $this->gedung->create($validatedData);

        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Gedung: ' . $e->getMessage());
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
        try {
            $validatedData = $request->validated();

            if ($request->hasfile('bast')) {
                if (!empty($gedung->bast)) {
                    Storage::disk('local')->delete('bast/gedung/' . $gedung->bast);
                }
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
                $file = $request->bast;
                Storage::disk('local')->put('bast/gedung/' . $filename, File::get($file));
                $validatedData['bast'] = $filename;
            } else {
                // If no new file is uploaded, keep the existing one
                $validatedData['bast'] = $gedung->bast;
            }

            // Ensure 'pihak_pertama' and 'status_sewa' are set to 'Sewa' if they are meant to be fixed
            if (!isset($validatedData['pihak_pertama'])) {
                $validatedData['pihak_pertama'] = 'Sewa';
            }
            if (!isset($validatedData['status_sewa'])) {
                $validatedData['status_sewa'] = 'Sewa';
            }
            
            $gedung->update($validatedData);

        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Gagal Mengubah Data Gedung: ' . $e->getMessage());
        }

        return redirect()->route('gedung.index')->with('success', 'Berhasil Mengubah Data gedung');
    }

    public function destroy(Gedung $gedung)
    {
        try {
            if (!empty($gedung->bast)) {
                Storage::disk('local')->delete('bast/gedung/' . $gedung->bast);
            }
            $gedung->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Hapus Data Gedung: ' . $e->getMessage());
        }
        return redirect()->route('gedung.index')->with('success', 'Berhasil Hapus Data gedung');
    }
}
