<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'master_unit';
    protected $fillable = ['kd_region', 'kd_area', 'kd_unit', 'nama_unit'];

    public function getAllData()
    {
        return $this->latest()->get();
    }
}
