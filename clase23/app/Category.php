<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\softDeletes;

class Category extends Model
{
    use softDeletes;  // agregado por borrado logico
    protected $guarded = [];

    public function products(){
        return $this->hasMany('App\Product', "category_id"); //tabla de destino y columna de FK local
    }
}
