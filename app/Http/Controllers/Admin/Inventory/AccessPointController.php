<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\AccessPoint;
use App\Models\Admin\MasterData\Region;
use App\Models\Admin\MasterData\Unit;
use Illuminate\Http\Request;

class AccessPointController extends Controller
{
    protected $accessPoint;
    protected $region;
    protected $unit;

    public function __construct(AccessPoint $accessPoint, Region $region, Unit $unit)
    {
        $this->accessPoint = $accessPoint;
        $this->region = $region;
        $this->unit = $unit;
    }

    public function index(Request $request)
    {
        $kd_region = $request->query('kd_region');
        $unit_id = $request->query('unit_id');

        $query = $this->accessPoint->with('region')->latest();

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        if ($unit_id) {
            $query->where('unit_id', $unit_id);
        }

        $datas = $query->get();

        return view('admin.inventory.access-point.index', [
            'datas' => $datas,
            'regions' => $this->region->getAllData(),
            'units' => $this->unit->getAllData(),
        ]);
    }
}
