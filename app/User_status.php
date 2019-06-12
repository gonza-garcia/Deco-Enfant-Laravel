<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_status extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function users()
    {
        return $this->hasMany('App\User','user_status_id');
    }
}
