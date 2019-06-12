<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function province()
    {
        return $this->belongsTo('App\Province', 'province_id');
    }
}
