<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Sex extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    //::::::::::::::::::has many::::::::::::::::::::
    public function users(){
      return $this->hasMany('App\User', "sex_id");
    }
}
