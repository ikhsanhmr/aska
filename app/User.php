<?php

namespace App;

use App\Models\Admin\MasterData\Region;
use App\Models\Admin\MasterData\Unit;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->password    = Hash::make($model->password);
        });

        self::updating(function ($model) {
            if ($model->isDirty('password') && !empty($model->password)) {
                $model->password = Hash::make($model->password);
            } else {
                $model->password = $model->getOriginal('password');
            }
        });
    }

    public function getAllData()
    {
        return $this->orderBy('updated_at', 'desc')->get();
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'kd_region', 'kd_region');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'kd_unit', 'kd_unit');
    }
}
