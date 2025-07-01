<?php

namespace App\Models\Admin\MasterData;

use App\Models\Admin\MasterData\NetworkContractIcon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopIconPlus extends Model
{
    use HasFactory;

    protected $table = 'pop_icon_pluses';
    protected $fillable = [
        'pop_icon_name', 
        'pop_icon_location'
    ];

    public function popIconServices()
    {
        return $this->hasMany(pop_icon_service::class, 'pop_icon_id', 'id');
    }


    public function getAllData()
    {
        return $this->with('popIconServices')->latest()->get();
    }
}
