<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    //::::::::::::::::::belongs to:::::::::::::::::::::
    public function category(){
      return $this->belongsTo('App\Category', "category_id");
    }

    //::::::::::::::::::has many:::::::::::::::::::::
    public function products(){
        return $this->hasMany('App\Product', "subcategory_id");
    }
    public function carts(){
        return $this->hasMany('App\Cart', "subcategory_id");
    }

}
