<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;  // agregado por borrado logico

    // public $table = "products"; // si la tabla se llamaba PLURAL DE LA CLASE no es obligatorio
    // public $primaryKey = "id"; // si es id, no es necesario escribirla
    // public $timestamps = false;
    public $guarded = []; // se pueden escribir todo lo que no este mencionado
    // public $fillable = [];  // Los campos que si se pueden escribir en la base


    public function users(){
      return $this->hasMany('App\User', "role_id");
    }
}
