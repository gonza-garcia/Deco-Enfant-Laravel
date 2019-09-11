<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    //::::::::::::::::::has many::::::::::::::::::::
    public function subcategories(){
        return $this->hasMany('App\Subcategory', "category_id");
    }
}
