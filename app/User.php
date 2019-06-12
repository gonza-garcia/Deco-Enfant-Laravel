<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = true;
    public $guarded = [];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'orders', 'user_id', 'product_id');
    }
    public function sex()
    {
        return $this->belongsTo('App\Sex', 'sex_id');
    }
    public function user_status()
    {
        return $this->belongsTo('App\User_status', 'user_status_id');
    }
    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

    function __construct(Array $datos)
    {
        if (isset($datos["id"])) {
            $this->id = $datos["id"];
            $this->password = $datos["password"];
        } else {
            $this->id = null;
            $this->password = password_hash($datos["password"], PASSWORD_DEFAULT);
        }

        $this->email = $datos["email"];

        if (isset($datos["user_name"]))
        {
            $this->user_name = $datos["user_name"];
            $this->first_name = $datos["first_name"];
            $this->last_name = $datos["last_name"];
            $this->date_of_birth = $datos["date_of_birth"];
            $this->phone = $datos["phone"];
            // $this->date_upload = $datos["date_upload"];
            // $this->date_update = $datos["date_update"];
            // $this->sex_id = $datos["sex_id"];
            // $this->user_status_id = $datos["user_status_id"];
            $this->role_id = 2;
        }

    }

    use Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

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
}
