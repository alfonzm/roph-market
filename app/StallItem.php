<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class StallItem extends Model
{
    protected $guarded = [];

    protected $appends = ['expired'];

    protected static function boot() {
        parent::boot();

        static::addGlobalScope('active', function(Builder $builder) {
            $builder->where('updated_at', '>=', Carbon::now()->subDays(env('STALL_ITEM_EXPIRY_DAYS', 30))->toDateTimeString());
        });
    }

    public function getExpiredAttribute() {
        return $this->updated_at < Carbon::now()->subDays(env('STALL_ITEM_EXPIRY_DAYS', 30))->toDateTimeString();
    }

    public function stall() {
    	return $this->belongsTo('App\Stall');
    }

    public function roItem() {
    	return $this->belongsTo('App\RoItem');
    }

    public function cards() {
        return $this->hasMany('App\StallItemCard');
    }

    public function roItemType() {
    	return $this->roItem()->roItemType();
    }
}
