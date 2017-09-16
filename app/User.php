<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function contacts() {
        return $this->hasMany('App\UserContact');
    }

    public function igns() {
        return $this->hasMany('App\UserIgn')->select(['ign', 'server_id']);
    }

    public function stalls() {
        return $this->hasMany('App\Stall');
    }

    public function groupIgns() {
        $this->attributes['groupedIgns'] = [];

        foreach($this->igns->load('server') as $ign) {
            $this->attributes['groupedIgns'][$ign->server->name][] = $ign->ign;
        }
    }
}
