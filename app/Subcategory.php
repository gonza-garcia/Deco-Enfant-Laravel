<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use SoftDeletes;  // agregado por borrado logico

    public $guarded = []; // se pueden escribir todo lo que no este mencionado
    // public $fillable = [];  // Los campos que si se pueden escribir en la base

    public function category(){
      return $this->belongsTo('App\Category', "category_id"); //Modelo que quiero retornarn (tabla de destino) y columna de FK local
    }

    public function products(){
        return $this->hasMany('App\Product', "subcategory_id"); //tabla de destino y columna de FK local
    }

    public function carts(){
        return $this->hasMany('App\Cart', "subcategory_id"); //tabla de destino y columna de FK local
    }

}
