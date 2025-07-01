<?php

namespace App\Models\Admin\Inventory;

use App\Models\Admin\MasterData\DeviceBrand;
use App\Models\Admin\MasterData\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilDinas extends Model
{
    use HasFactory;
    protected $table = 'mobil_dinas';
    protected $guarded = ['id'];

    public function getAllData()
    {
        return $this->latest()->get();
    }


    public function brand()
    {
        return $this->belongsTo(DeviceBrand::class, 'brand_id', 'id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'kd_region', 'kd_region');
    }
}
