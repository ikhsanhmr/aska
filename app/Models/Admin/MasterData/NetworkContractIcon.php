<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkContractIcon extends Model
{
    use HasFactory;
    protected $table = 'network_contract_icons';
    protected $fillable = ['activation_date', 'service_id', 'service', 'unit_id', 'explanation', 'activation_number', 'scada', 'capacity', 'price','status','asman', 'month', 'year'];
    public function getUnits()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function getAllData()
    {
        return $this->with(['getUnits'])
            ->latest()
            ->get();
    }
}
