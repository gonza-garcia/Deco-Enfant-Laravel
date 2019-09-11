<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    public $timestamps = true;
    protected $guarded = [];

    //The attributes that should be hidden for arrays.
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];

    public function hasRole($role)
    {
        return $this->role_id == $role;
    }

    //::::::::::::::::::has many:::::::::::::::::::::
    public function products(){
        return $this->hasMany('App\Product', "user_id");
    }
    public function carts(){
        return $this->hasMany('App\Cart', "user_id");
    }

    //::::::::::::::::::belongs to:::::::::::::::::::::
    public function province(){
        return $this->belongsTo('App\Province', "province_id");
    }
    public function sex(){
        return $this->belongsTo('App\Sex', "sex_id");
    }
    public function role(){
        return $this->belongsTo('App\Role', "role_id");
    }
    public function user_status(){
        return $this->belongsTo('App\User_status', "user_status_id");
    }
}
