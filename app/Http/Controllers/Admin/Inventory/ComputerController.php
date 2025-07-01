<?php


namespace App\Http\Controllers\Admin\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\MasterData\Region;
use App\Http\Requests\ComputerRequest;
use App\Models\Admin\MasterData\Vendor;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Inventory\Computer;
use App\Models\Admin\MasterData\DeviceBrand;
use \Illuminate\Support\Facades\File;

class ComputerController extends Controller
{
    private $computer;
    private $vendor;
    private $region;
    private $brand;
    public function __construct(Computer $computer, Vendor $vendor, Region $region, DeviceBrand $brand)
    {
        $this->computer = $computer;
        $this->vendor = $vendor;
        $this->region = $region;
        $this->brand = $brand;

    }

    public function index()
    {
        return view('admin.inventory.computers.index', ['datas' => $this->computer->getAllData()]);
    }


    public function create()
    {
        return view('admin.inventory.computers.create', [
            'vendors' => $this->vendor->getAllData(),
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandComputers()
        ]);
    }


    public function store(ComputerRequest $request)
    {
        try {
            if($request->hasfile('bast')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('bast')->getClientOriginalName());
                $file = $request->file('bast');
                Storage::disk('local')->put('bast/computers/'.$filename, File::get($file));
                $data = [
                     'name' =>  $request->name,
                     'kd_region' =>  $request->kd_region,
                     'serial_number' => $request->serial_number,
                     'brand_id' => $request->brand_id,
                     'spesification'=> $request->spesification,
                     'ip_address' => $request->ip_address,
                     'user_name' => $request->user_name,
                     'unit_id' => $request->unit_id,
                     'ownership_status' => $request->ownership_status,
                     'year' => $request->year,
                     'vendor' => $request->vendor,
                     'system_operation' => $request->system_operation,
                     'office' => $request->office,
                     'status_id' => $request->status_id,
                     'kes' => $request->kes,
                     'mouse' => $request->mouse,
                     'keyboard' => $request->keyboard,
                     'monitor' => $request->monitor,
                     'contract_date' => $request->contract_date,
                     'rental_price' => $request->rental_price,
                     'bast' => $filename
                ];
                $this->computer->create($data);
            }else{
                $this->computer->create($request->validated());
            }

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah Data Komputer');
        }
        return redirect()->route('computers.index')->with('success', 'Berhasil Tambah Data Komputer');
    }


    public function show()
    {
        //
    }


    public function edit(Computer $computer)
    {
        return view('admin.inventory.computers.edit', [
            'computer' => $computer,
            'vendors' => $this->vendor->getAllData(),
            'regions' => $this->region->getAllData(),
            'brands' => $this->brand->getBrandComputers()
        ]);
    }


    public function update(ComputerRequest $request, Computer $computer)
    {
        if ($request->hasfile('bast')) {

            if (!empty($computer->bast)) {
                Storage::disk('local')->delete('bast/computers/' . $computer->bast);
            }

            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bast')->getClientOriginalName());
            $file = $request->bast;

            $data = [
                'name' =>  $request->name,
                'kd_region' =>  $request->kd_region,
                'serial_number' => $request->serial_number,
                'brand_id' => $request->brand_id,
                'spesification'=> $request->spesification,
                'ip_address' => $request->ip_address,
                'user_name' => $request->user_name,
                'unit_id' => $request->unit_id,
                'ownership_status' => $request->ownership_status,
                'year' => $request->year,
                'vendor' => $request->vendor,
                'system_operation' => $request->system_operation,
                'office' => $request->office,
                'status_id' => $request->status_id,
                'kes' => $request->kes,
                'mouse' => $request->mouse,
                'keyboard' => $request->keyboard,
                'monitor' => $request->monitor,
                'contract_date' => $request->contract_date,
                'rental_price' => $request->rental_price,
                'bast' => $filename
           ];

            $computer->update($data);
            Storage::disk('local')->put('bast/computers/' . $filename, File::get($file));
        } else {

            $computer->update($request->validated());

        }

  return redirect()->route('computers.index')->with('success', 'Berhasil Mengubah Data Komputer');

}


    public function destroy(Computer $computer)
    {
        if (!empty($computer->bast)) {
            Storage::disk('local')->delete('bast/computers/' . $computer->bast);
        }
        $computer->delete();
        return redirect()->route('computers.index')->with('success', 'Berhasil Hapus Data Komputer');
    }
}
