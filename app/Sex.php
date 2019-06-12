<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function users()
    {
        return $this->hasMany('App\User','sex_id');
    }
}
