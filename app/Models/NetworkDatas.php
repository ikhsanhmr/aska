<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkDatas extends Model
{
    use HasFactory;


    public function getAllData()
    {
        return $this->latest()->get();
    }

}
