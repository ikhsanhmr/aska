<?php

namespace App\Models\Admin\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\MasterData\Region;

class Starlink extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'starlink'; // <--- TAMBAHKAN BARIS INI

    protected $guarded = ['id'];

    // Relasi ke Region (PENTING untuk filter)
    public function region()
    {
        return $this->belongsTo(Region::class, 'kd_region', 'kd_region');
    }
}