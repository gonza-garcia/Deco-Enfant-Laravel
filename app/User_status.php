<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class User_status extends Model
{
    use SoftDeletes;  // agregado por borrado logico
    protected $guarded = [];

    public function users(){
      return $this->hasMany('App\User', "user_status_id");
    }
}
