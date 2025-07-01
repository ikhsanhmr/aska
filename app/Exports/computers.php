<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\Models\Admin\Inventory\Computer;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;

class computers implements FromView
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
        $results = Computer::when($this->unit_id !== null, function ($query) {
            $query->where('unit_id', $this->unit_id);
        })
        ->when($this->status !== null, function ($query) {
            $query->where('ownership_status', $this->status);
        })
        ->get(); 

        return view('admin.report.xls.computers', [
            'datas' => $results,
        ]);
    }



}
