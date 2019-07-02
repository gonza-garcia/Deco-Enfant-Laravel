<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    use softDeletes;  // agregado por borrado logico
    protected $guarded = [];
}
