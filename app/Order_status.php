<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_status extends Model
{
    use SoftDeletes;  // agregado por borrado logico
    protected $guarded = [];

    public function carts(){
        return $this->hasMany('App\Cart', "order_status_id"); //tabla de destino y columna de FK local
    }
}
