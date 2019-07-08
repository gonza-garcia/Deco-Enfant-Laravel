<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\softDeletes;

class Category extends Model
{
    use softDeletes;  // agregado por borrado logico
    protected $guarded = [];

    public function subcategories(){
        return $this->hasMany('App\Subcategory', "category_id"); //tabla de destino y columna de FK local
    }
}
