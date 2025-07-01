<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $table = 'master_region';
    protected $guarded = ['id'];

    public function getAllData()
    {
        return $this->orderBy('created_at', 'desc')->get();
    }
}
