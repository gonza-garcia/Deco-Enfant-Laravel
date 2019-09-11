<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    //::::::::::::::::::belongs to::::::::::::::::::::
    public function country(){
        return $this->belongsTo('App\Country', "country_id");
    }

    //::::::::::::::::::has many::::::::::::::::::::
    public function users(){
        return $this->hasMany('App\User', "province_id");
    }
}
