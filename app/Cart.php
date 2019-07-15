<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;  // agregado por borrado logico
    protected $guarded = [];

    public function user(){
      return $this->belongsTo('App\User', "user_id"); //Modelo que quiero retornarn (tabla de destino) y columna de FK local
    }

    public function color(){
      return $this->belongsTo('App\Color', "color_id"); //Modelo que quiero retornarn (tabla de destino) y columna de FK local
    }

    public function size(){
      return $this->belongsTo('App\Size', "size_id"); //Modelo que quiero retornarn (tabla de destino) y columna de FK local
    }

    public function subcategory(){
      return $this->belongsTo('App\Subcategory', "subcategory_id"); //Modelo que quiero retornarn (tabla de destino) y columna de FK local
    }

}
