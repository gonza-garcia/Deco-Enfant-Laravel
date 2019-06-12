<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address', 'province_id');
    }
}
