<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    //::::::::::::::::::has many::::::::::::::::::::
    public function users(){
      return $this->hasMany('App\User', "role_id");
    }
}
