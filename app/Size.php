<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\softDeletes;

class Size extends Model
{
    use softDeletes;  // agregado por borrado logico

    // public $table = "products"; // si la tabla se llamaba PLURAL DE LA CLASE no es obligatorio
    // public $primaryKey = "id"; // si es id, no es necesario escribirla
    // public $timestamps = false;
    public $guarded = []; // se pueden escribir todo lo que no este mencionado
    // public $fillable = [];  // Los campos que si se pueden escribir en la base

    public function products(){
        return $this->hasMany('App\Product', "size_id"); //tabla de destino y columna de FK local
    }

    public function carts(){
        return $this->hasMany('App\Cart', "size_id"); //tabla de destino y columna de FK local
    }
}
