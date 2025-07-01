<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'master_area';
    protected $fillable = ['kd_region','kd_area','nama_area'];

    public function getAllData()
    {
        return $this->latest()->get();
    }

    /**
     * Get the region that owns the Area
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'kd_region', 'kd_region');
    }
    
}
