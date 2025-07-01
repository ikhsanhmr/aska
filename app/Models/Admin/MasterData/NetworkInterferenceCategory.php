<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkInterferenceCategory extends Model
{
    use HasFactory;

    protected $table = 'network_interference_categories';
    protected $fillable = [
        'name' 
    ];

    public function getAllData()
    {
        return $this->latest()->get();
    }
}
