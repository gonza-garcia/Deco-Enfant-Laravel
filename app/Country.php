<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    //::::::::::::::::::has many::::::::::::::::::::
    public function provinces(){
        return $this->hasMany('App\Province', "country_id");
    }
}
