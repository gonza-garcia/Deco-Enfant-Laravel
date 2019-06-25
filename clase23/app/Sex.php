<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\softDeletes;

class Sex extends Model
{
    use softDeletes;  // agregado por borrado logico
    protected $guarded = [];

    public function users(){
      return $this->hasMany('App\User', "sex_id");
    }
}
