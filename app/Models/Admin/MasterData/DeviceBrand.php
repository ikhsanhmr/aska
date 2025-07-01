<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Database\Factories\AdminMasterDataDeviceBrandFactory;
use Database\Factories\Admin\MasterData\DeviceBrandFactory;

class DeviceBrand extends Model
{
    use HasFactory;
    protected $table = 'device_brands';
    protected $fillable = [
        'name',
        'category'
    ];
    protected static function newFactory()
    {
        return DeviceBrandFactory::new();
    }
    public function getAllData()
    {
        return $this->latest()->get();
    }
    public function getBrandLaptops()
    {
        return $this->where('category', 'laptop')->latest()->get();
    }
    public function getBrandHandphone()
    {
        return $this->where('category', 'handphone')->latest()->get();
    }
    public function getBrandCctv()
    {
        return $this->where('category', 'cctv')->latest()->get();
    }
    public function getBrandTelevision()
    {
        return $this->where('category', 'tv')->latest()->get();
    }

    public function getBrandMobil()
    {
        return $this->where('category', 'mobil')->latest()->get();
    }

    public function getBrandMotor()
    {
        return $this->where('category', 'motor')->latest()->get();
    }
    public function getBrandComputers()
    {
        return $this->where('category', 'komputer')->latest()->get();
    }

    public function getBrandMonitors()
    {
        return $this->where('category', 'monitor')->latest()->get();
    }

    public function getBrandPrinters()
    {
        return $this->where('category', 'printer')->latest()->get();
    }
    public function getBrandServers()
    {
        return $this->where('category', 'server')->latest()->get();
    }
    public function getBrandNetworkDevices()
    {
        return $this->where('category', 'network device')->latest()->get();
    }
    public function getAllCategory()
    {
        return $this->select('category')->get();
    }
}
