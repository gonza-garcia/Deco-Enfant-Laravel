<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function orders()
    {
        return $this->hasMany('App\Order','order_status_id');
    }
}
