<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoItemType extends Model
{
    protected $guarded = [];

    public function roItems() {
    	return $this->hasMany('App\RoItem');
    }

    public function stallItems() {
    	return $this->hasMany('App\StallItem');
    }
}
