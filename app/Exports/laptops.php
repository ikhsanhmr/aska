<?php

namespace App\Exports;
use App\Models\Admin\Inventory\Laptop;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class laptops implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $jenis;
    protected $unit_id;
    protected $status;

    public function __construct($jenis, $unit_id, $status)
    {
        $this->jenis = $jenis;
        $this->unit_id = $unit_id;
        $this->status = $status;
    }

    public function view(): View
    {
        $results = Laptop::when($this->unit_id !== null, function ($query) {
            $query->where('unit_id', $this->unit_id);
        })
        ->when($this->status !== null, function ($query) {
            $query->where('ownership_status', $this->status);
        })
        ->get(); 

        return view('admin.report.xls.laptops', [
            'datas' => $results,
        ]);
    }
}
