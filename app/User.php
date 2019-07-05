<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// agregado para soft delete
use Illuminate\Database\Eloquent\softDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use softDeletes;  // agregado por borrado logico

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    //     'first_name','last_name'
    // ];
    protected $guarded = [];

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

    public function hasRole($role_id)
    {
        return User::where('role_id', $role_id)->get();
    }

    public function products(){
        return $this->hasMany('App\Product', "user_id"); //tabla de destino y columna de FK local
    }

    public function role(){
        return $this->belongsTo('App\Role', "role_id");
    }
    public function sex(){
        return $this->belongsTo('App\Sex', "sex_id");
    }
    public function users_statuses(){
        return $this->belongsTo('App\User_status', "user_status_id");
    }
}
