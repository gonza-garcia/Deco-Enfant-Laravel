<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping_status extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function orders()
    {
        return $this->hasMany('App\Order','shipping_status_id');
    }
}
