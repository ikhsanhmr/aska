<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Models\Admin\MasterData\ItSupport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItSupportRequest;
use Illuminate\Support\Facades\Log;

class ItSupportController extends Controller
{

    private $support;

    public function __construct(ItSupport $support)
    {
        $this->support = $support;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master_data.it_support.index', ['data' => $this->support->getAllData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.it_support.create', ['data' => $this->support->getAllData()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItSupportRequest $Supportrequest)
    {
       
        try {
            $this->support->create($Supportrequest->validated());
        } catch (\Exception $e) {

            Log::error('Pesan Kesalahan: ' . $e->getMessage()); // Menyimpan pesan kesalahan ke dalam file log

            return redirect()->back()->withInput()->with('error', 'Data Gagal Ditambahkan');
        }
        return redirect()->route('support.index')->with('success', 'Data Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(ItSupport $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItSupport $support)
    {
        return view('admin.master_data.it_support.edit', ['support' => $support]);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ItSupportRequest $request, ItSupport $support)
    {
        try {
            $support->update($request->validated());
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Data Gagal Diubah');
        }
        return redirect()->route('support.index')->with('success', 'Data Berhasil Diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItSupport $support)
    {
        $support->delete();
        return redirect()->route('support.index')->with('success', 'Data Berhasil Dihapus');

    }
}
