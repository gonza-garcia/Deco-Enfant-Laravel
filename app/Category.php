<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;  // agregado por borrado logico
    protected $guarded = [];

    public function subcategories(){
        return $this->hasMany('App\Subcategory', "category_id"); //tabla de destino y columna de FK local
    }
}
