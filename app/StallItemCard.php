<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StallItemCard extends Model
{
    protected $guarded = [];

    public function stallItem() {
    	return $this->belongsTo('App\StallItem');
    }

    public function roItem() {
    	return $this->belongsTo('App\RoItem', 'card_id');
    }
}
