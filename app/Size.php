<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function products()
    {
        return $this->hasMany('App\Product', 'size_id');
    }
}
