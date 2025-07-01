<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItSupport extends Model
{
    use HasFactory;
    protected $table = 'it_supports';
    protected $fillable = [
        'name',
        'handphone',
        'email',
        'location',
    ];

    public function getAllData()
    {
        return $this->latest()->get();
    } 

}
