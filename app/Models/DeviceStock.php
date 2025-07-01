<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceStock extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function getAllData()
    {
        return $this->latest()->get();
    }
}
