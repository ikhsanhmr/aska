<?php

namespace App\Models\Admin\Inventory;

use App\Models\Admin\MasterData\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;
    protected $table = 'gedung';
    protected $guarded = ['id'];

    public function getAllData()
    {
        return $this->latest()->get();
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'kd_up', 'kd_region');
    }
}
