<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// agregado para soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    protected $guarded = [];

    protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
      'deleted_at' => 'datetime',
    ];

    //::::::::::::::::::belongs to:::::::::::::::::::::
    public function user(){
      return $this->belongsTo('App\User', "user_id");
    }
    public function color(){
      return $this->belongsTo('App\Color', "color_id");
    }
    public function size(){
      return $this->belongsTo('App\Size', "size_id");
    }
    public function subcategory(){
      return $this->belongsTo('App\Subcategory', "subcategory_id");
    }

}
