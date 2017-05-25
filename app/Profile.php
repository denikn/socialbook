<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $table='profile';

	protected $fillable = [
        'uid', 'name', 'avatar', 'origin', 'about',
    ];

    /*protected $hidden = [
        'created_at', 'updated_at',
    ];*/    

    public function login()
    {
        return $this->belongsTo('App\Login','uid','uid');
    }

    public function friends()
    {
        return $this->belongsTo('App\Friends','uid','uid');
    }

    public function rev_showID()
    {
        return $this->belongsTo('App\Messageboard','uid','uid');
    }

    public function rev_showID2()
    {
        return $this->belongsTo('App\Messageboard','uid','uid');
    }
}
