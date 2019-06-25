<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\softDeletes;

class Shipping_status extends Model
{
    use softDeletes;  // agregado por borrado logico
    protected $guarded = [];
}
