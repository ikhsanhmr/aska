<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pop_icon_service extends Model
{
    use HasFactory;

    protected $table = 'pop_icon_services';
    protected $fillable = [
        'service_id', 
        'pop_icon_id',
    ];


    public function networkContractCategory()
    {
        return $this->belongsTo(NetworkContractIcon::class, 'service_id', 'service_id');
    }
    

}
