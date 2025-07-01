<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\MasterData\Unit;

class AppsLocal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'link',
        'username',
        'password',
        'database_type',
        'unit_id' 
    ];
    
    public function getAllData()
    {
        return $this->latest()->get();
    }

    public function getUnits()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}