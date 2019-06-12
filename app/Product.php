<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true;
    public $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\User','orders', 'product_id', 'user_id');
    }
    public function color()
    {
        return $this->belongsTo('App\Color', 'color_id');
    }
    public function size()
    {
        return $this->belongsTo('App\Size', 'size_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
