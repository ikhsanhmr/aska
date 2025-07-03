<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inventory\AccessPoint;
use App\Models\Admin\MasterData\Region;
use App\Models\Admin\MasterData\Unit;
use Illuminate\Http\Request;

class AccessPointController extends Controller
{
    public function index(Request $request)
    {
        $kd_region = $request->query('kd_region');
        $query = AccessPoint::with('region')->latest();

        if ($kd_region) {
            $query->where('kd_region', $kd_region);
        }

        $datas = $query->get();

        $regions = Region::all();

        return view('admin.inventory.access-point.index', compact('datas', 'regions'));
    }
}
