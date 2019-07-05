<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\softDeletes;

class Product extends Model
{
    use softDeletes;  // agregado por borrado logico
    // public $table = "products"; // si la tabla se llamaba PLURAL DE LA CLASE no es obligatorio
    // public $primaryKey = "id"; // si es id, no es necesario escribirla
    // public $timestamps = false;
    public $guarded = []; // se pueden escribir todo lo que no este mencionado
    // public $fillable = [];  // Los campos que si se pueden escribir en la base

    public function color(){
      return $this->belongsTo('App\Color', "color_id"); //Modelo que quiero retornarn (tabla de destino) y columna de FK local
    }

    public function user(){
      return $this->belongsTo('App\User', "user_id"); //Modelo que quiero retornarn (tabla de destino) y columna de FK local
    }

    public function category(){
      return $this->belongsTo('App\Category', "category_id"); //Modelo que quiero retornarn (tabla de destino) y columna de FK local
    }

    public function size(){
      return $this->belongsTo('App\Size', "size_id"); //Modelo que quiero retornarn (tabla de destino) y columna de FK local
    }

}
