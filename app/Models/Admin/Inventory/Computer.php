<?php

namespace App\Models\Admin\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use App\Models\Admin\MasterData\Unit;
use App\Models\Admin\MasterData\Vendor;

class Computer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getDeviceBrands()
    {
        return $this->belongsTo(DeviceBrand::class, 'brand_id', 'id');
    }

    public function getUnits()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function getVendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function getAllData()
    {
        return $this->with(['getDeviceBrands', 'getUnits', 'getVendor'])->latest()->get();
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'kd_region', 'kd_region');
    }

}
