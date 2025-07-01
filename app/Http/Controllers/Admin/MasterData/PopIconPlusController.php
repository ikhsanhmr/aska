<?php

namespace App\Http\Controllers\Admin\MasterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\PopIconRequest;
use App\Http\Requests\PopIconServiceRequest;
use App\Models\Admin\MasterData\pop_icon_service;
use App\Models\Admin\MasterData\PopIconPlus;
use App\Models\Admin\MasterData\NetworkContractIcon;
use Illuminate\Http\Request;

class PopIconPlusController extends Controller
{
    
    private $popiconplus;
    private $network;
    public function __construct(PopIconPlus $popiconplus, NetworkContractIcon $network)
    {
        $this->popiconplus = $popiconplus;
        $this->network = $network;
    }
    
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        return view(
            'admin.master_data.pop_icon_plus.index',
            [
                'datas' => $this->popiconplus->getAllData()
                ]
            );
        }
        
        /**
        * Show the form for creating a new resource.
        */
        public function create()
        {
            return view('admin.master_data.pop_icon_plus.create', [
                'networks' => $this->network->getAllData(),  
            ]);
        }
        
        /**
        * Store a newly created resource in storage.
        */
        public function store(PopIconRequest $request, PopIconServiceRequest $requestservice)
        {
            try {
                // Validasi data input dari PopIconRequest
                $validatedData = $request->validated();
                $validatedService = $requestservice->validated();
                
                // Buat instance PopIconPlus dan simpan ke database
                $newPopIcon = PopIconPlus::create([
                    'pop_icon_name' => $validatedData['pop_icon_name'],
                    'pop_icon_location' => $validatedData['pop_icon_location'],
                ]);
                
                // Dapatkan ID baru yang disimpan
                $id_next = $newPopIcon->id;
                
                // Loop melalui service_id yang dipilih dan simpan ke database
                foreach ($validatedService['service_id'] as $serviceId) {
                    pop_icon_service::create([
                        'pop_icon_id' => $id_next,
                        'service_id' => $serviceId,
                    ]);
                }
                
                // Berhasil menambahkan data, kembalikan pesan sukses
                return redirect(route('popicon.index'))->with('success', 'Berhasil Menambah Data');
            } catch (\Exception $e) {
                // Tangani kesalahan dengan baik dan berikan pesan kesalahan yang lebih deskriptif
                return redirect(route('popicon.index'))->with('error', 'Gagal Menambah Data: ' . $e->getMessage());
            }
        }
        
        /**
        * Display the specified resource.
        */
        public function show(PopIconPlus $popicon)
        {
            //
        }
        
        /**
        * Show the form for editing the specified resource.
        */
        public function edit(PopIconPlus $popicon)
        {
            return view('admin.master_data.pop_icon_plus.edit', [
                'networks' => $this->network->getAllData(), 
                'popicon' => $popicon, 
            ]);
        }
        
        /**
        * Update the specified resource in storage.
        */
        public function update(PopIconRequest $request, PopIconServiceRequest $requestservice, PopIconPlus $popicon)
        {
            try {
                
                $popIcon = PopIconPlus::find($popicon->id);
                
                $popIcon->update([
                    'pop_icon_name' => $request->pop_icon_name,
                    'pop_icon_location' => $request->pop_icon_location,
                ]);
                
                pop_icon_service::where('pop_icon_id', $popicon->id)->delete();
                
                $jumlahrequestService = count($requestservice->service_id);
                
                for($x=0; $x<$jumlahrequestService; $x++){
                    pop_icon_service::create([
                        'pop_icon_id' => $popicon->id,
                        'service_id' => $requestservice->service_id[$x]
                    ]);
                }
                
            } catch (\Exception $e) {
                return redirect(route('popicon.index'))->with('error', 'Gagal Menubah Data' . $e->getMessage());
            }
            return redirect(route('popicon.index'))->with('success', 'Berhasil Menubah Data');
        }
        
        /**
        * Remove the specified resource from storage.
        */
        public function destroy(PopIconPlus $popicon)
        {
            // Periksa ketersediaan data
            if (!$popicon) {
                return redirect()
                ->route('popicon.index')
                ->with('error', 'Data tidak ditemukan');
            }
            
            // Hapus relasi terkait (jika ada)
            pop_icon_service::where('pop_icon_id', $popicon->id)->delete();
            
            // Hapus entitas utama
            $popicon->delete();
            
            return redirect()
            ->route('popicon.index')
            ->with('success', 'Berhasil hapus data');
        }
        
    }
    