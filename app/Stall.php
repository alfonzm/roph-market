<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    protected $guarded = [];

    public function stallItems() {
    	return $this->hasMany('App\StallItem');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function server() {
    	return $this->belongsTo('App\Server');
    }
}
