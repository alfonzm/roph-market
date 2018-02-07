<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Stall extends Model
{
    protected $guarded = [];

    public function stallItems() {
        return $this->hasMany('App\StallItem');
    }

    public function myStallItems() {
    	return $this->hasMany('App\StallItem')->withoutGlobalScopes();
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function server() {
    	return $this->belongsTo('App\Server');
    }
}
