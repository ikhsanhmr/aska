<?php

namespace App\Http\Controllers\Admin\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LaptopRequest;
use App\Models\Admin\Inventory\Laptop;
use App\Models\Admin\MasterData\Unit;
use App\Models\Admin\MasterData\Vendor;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use App\User;
use \Illuminate\Support\Facades\File;

class LaptopController extends Controller
{
    private $laptop;
    private $vendor;
    private $unit;
    private $brand;
    private $region;
    private $user;
    public function __construct(Laptop $laptop, Vendor $vendor, Unit $unit, DeviceBrand $brand,Region $region,User $user)
    {
        $this->laptop  = $laptop;
        $this->vendor = $vendor;
        $this->unit = $unit;
        $this->brand = $brand;
        $this->region = $region;
        $this->user = $user;

    }


    public function index()
    {
        return view('admin.inventory.laptops.index',  ['datas' => $this->laptop->getAllData()]);
    }


    public function create()
    {

        return view('admin.inventory.laptops.create', [
            'users' => $this->user->getAllData(),
            'vendors' => $this->vendor->getAllData(),
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandLaptops()
        ]);
    }


    public function store(LaptopRequest $request)
    {
        // dd($request->all());
        try {
            $data = $request->validated();
            if($request->hasfile('bast')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('bast')->getClientOriginalName());
                $file = $request->file('bast');
                Storage::disk('local')->put('bast/laptops/'.$filename, File::get($file));
                $data['bast']= $filename;
            }
            if($request->hasfile('bastp')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('bastp')->getClientOriginalName());
                $file = $request->file('bastp');
                Storage::disk('local')->put('bastp/laptops/'.$filename, File::get($file));
                $data['bastp']= $filename;
            }
            if($request->hasfile('form_permintaan')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('form_permintaan')->getClientOriginalName());
                $file = $request->file('form_permintaan');
                Storage::disk('local')->put('form_permintaan/laptops/'.$filename, File::get($file));
                $data['form_permintaan']= $filename;
            }
            if($request->hasfile('data_kontrak')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('data_kontrak')->getClientOriginalName());
                $file = $request->file('data_kontrak');
                Storage::disk('local')->put('data_kontrak/laptops/'.$filename, File::get($file));
                $data['data_kontrak']= $filename;
            }
            if($request->hasfile('foto')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('foto')->getClientOriginalName());
                $file = $request->file('foto');
                Storage::disk('local')->put('foto/laptops/'.$filename, File::get($file));
                $data['foto']= $filename;
            }
            $this->laptop->create($data);

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Laptop');
        }
        return redirect()->route('laptops.index')->with('success', 'Berhasil Tambah Data Laptop');
    }


    public function show()
    {
        //
    }


    public function edit(Laptop $laptop)
    {
        return view('admin.inventory.laptops.edit', [
            'users' => $this->user->getAllData(),
            'laptop' => $laptop,'vendors' => $this->vendor->getAllData(),
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandLaptops()
        ]);
    }


    public function update(LaptopRequest $request, Laptop $laptop)
    {
        try {
            $data = $request->validated();
            if ($request->hasfile('bast')) {

                if (!empty($laptop->bast)) {
                    Storage::disk('local')->delete('bast/laptops/' . $laptop->bast);
                }

                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
                $file = $request->bast;
                Storage::disk('local')->put('bast/laptops/' . $filename, File::get($file));

                $data['bast'] = $filename;
            }
            if ($request->hasfile('bastp')) {

                if (!empty($laptop->bastp)) {
                    Storage::disk('local')->delete('bastp/laptops/' . $laptop->bastp);
                }

                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bastp')->getClientOriginalName());
                $file = $request->bastp;
                Storage::disk('local')->put('bastp/laptops/' . $filename, File::get($file));

                $data['bastp'] = $filename;
            }
            if ($request->hasfile('form_permintaan')) {

                if (!empty($laptop->form_permintaan)) {
                    Storage::disk('local')->delete('form_permintaan/laptops/' . $laptop->form_permintaan);
                }

                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('form_permintaan')->getClientOriginalName());
                $file = $request->form_permintaan;
                Storage::disk('local')->put('form_permintaan/laptops/' . $filename, File::get($file));

                $data['form_permintaan'] = $filename;
            }
            if ($request->hasfile('data_kontrak')) {

                if (!empty($laptop->data_kontrak)) {
                    Storage::disk('local')->delete('data_kontrak/laptops/' . $laptop->data_kontrak);
                }

                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('data_kontrak')->getClientOriginalName());
                $file = $request->data_kontrak;
                Storage::disk('local')->put('data_kontrak/laptops/' . $filename, File::get($file));

                $data['data_kontrak'] = $filename;
            }
            if ($request->hasfile('foto')) {

                if (!empty($laptop->foto)) {
                    Storage::disk('local')->delete('foto/laptops/' . $laptop->foto);
                }

                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('foto')->getClientOriginalName());
                $file = $request->foto;
                Storage::disk('local')->put('foto/laptops/' . $filename, File::get($file));

                $data['foto'] = $filename;
            }
            $laptop->update($data);

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal Mengubah Data Laptop');
        }
        return redirect()->route('laptops.index')->with('success', 'Berhasil Mengubah Data laptop');
    }


    public function destroy(Laptop $laptop)
    {

        if (!empty($laptop->bast)) {
            Storage::disk('local')->delete('bast/laptops/' . $laptop->bast);
        }
        $laptop->delete();
        return redirect()->route('laptops.index')->with('success', 'Berhasil Hapus Data Laptop');
    }
}
