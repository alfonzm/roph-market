<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIgn extends Model
{
    protected $guarded = [];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function server() {
    	return $this->belongsTo('App\Server');
    }
}
