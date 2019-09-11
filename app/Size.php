<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    //::::::::::::::::::has many:::::::::::::::::::::
    public function products(){
        return $this->hasMany('App\Product', "size_id");
    }
    public function carts(){
        return $this->hasMany('App\Cart', "size_id");
    }
}
