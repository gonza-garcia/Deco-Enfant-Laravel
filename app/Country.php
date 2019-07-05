<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\softDeletes;

class Country extends Model
{
    use softDeletes;  // agregado por borrado logico

    public $guarded = []; // se pueden escribir todo lo que no este mencionado
    // public $fillable = [];  // Los campos que si se pueden escribir en la base
}
