<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $guarded = [];

    public function igns() {
    	return $this->hasMany('App\UserIgn');
    }

    public function stalls() {
    	return $this->hasMany('App\Stall');
    }
}
