<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table='login';

    protected $fillable = [
        'uid', 'email', 'username', 'password',
    ];

    protected $hidden = [
        'password', 'created_at', 'updated_at',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile','uid','uid');
    }

    /*public function friendship()
    {
    	return $this->hasMany('App\Friendship','unique_id','unique_id');
    }*/
}
