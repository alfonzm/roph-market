<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StallItem extends Model
{
    protected $guarded = [];

    public function stall() {
    	return $this->belongsTo('App\Stall');
    }

    public function roItem() {
    	return $this->belongsTo('App\RoItem');
    }

    public function roItemType() {
    	return $this->roItem()->roItemType();
    }
}
