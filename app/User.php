<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = true;
    public $guarded = [];

    function __construct(Array $datos)
    {
        if (isset($datos["id"])) {
            $this->id = $datos["id"];
            $this->pass = $datos["pass"];
        } else {
            $this->id = null;
            $this->pass = password_hash($datos["pass"], PASSWORD_DEFAULT);
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
