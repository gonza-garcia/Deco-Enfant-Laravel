<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function products()
    {
        return $this->hasMany('App\Product', 'color_id');
    }
}
