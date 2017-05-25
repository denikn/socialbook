<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $table='friends';

    protected $fillable = [
        'uid', 'friend', 'status',
    ];

    /**/

    public function profile()
    {
        return $this->hasMany('App\Profile','uid','friend');
    }

    public function friendreq()
    {
        return $this->hasMany('App\Profile','uid','uid');
    }

    public function messageboard()
    {
    	return $this->belongsTo('App\Messageboard', 'uid', 'friend');
    }
}
