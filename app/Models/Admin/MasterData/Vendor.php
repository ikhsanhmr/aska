<?php

namespace App\Models\Admin\MasterData;


use Illuminate\Database\Eloquent\Model;
use Database\Factories\Admin\MasterData\VendorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'master_vendor';
    protected $fillable = [
        'name',
        'address',
        'telephone'
    ];
    protected static function newFactory()
    {
        return VendorFactory::new();
    }
    public function getAllData()
    {
        return $this->latest()->get();
    }
}