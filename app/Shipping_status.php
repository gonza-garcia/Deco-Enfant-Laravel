<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping_status extends Model
{
    use SoftDeletes;  // agregado por borrado logico
    protected $guarded = [];
}
