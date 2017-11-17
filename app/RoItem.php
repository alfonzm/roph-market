<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoItem extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function roItemType() {
    	return $this->belongsTo('App\RoItemType');
    }

    public function stallItems() {
    	return $this->hasMany('App\StallItem');
    }
}
