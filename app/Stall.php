<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    protected $guarded = [];

    public function stallItems() {
    	return $this->hasMany('App\StallItem');
    }
}
