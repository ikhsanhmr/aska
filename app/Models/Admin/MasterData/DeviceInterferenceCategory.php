<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceInterferenceCategory extends Model
{
    use HasFactory;
    protected $table = 'device_interference_categories';
    protected $fillable = [
        'name' 
    ];

    public function getAllData()
    {
        return $this->latest()->get();
    }
    
}
