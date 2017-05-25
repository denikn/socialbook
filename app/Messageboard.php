<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messageboard extends Model
{
    protected $table='messageboard';

    protected $fillable = [
        'id_books', 'uid', 'message', 'id_chapter', 'parent', 'media', 'type'
    ];

    /*protected $hidden = [
        'created_at', 'updated_at',
    ];*/

    public function books()
    {
        return $this->belongsTo('App\Books','id_books', 'id_books');
    }

    public function showFriend()
    {
    	return $this->hasOne('App\Friends', 'friend', 'uid');
    }

    public function showID()
    {
        return $this->hasOne('App\Profile', 'uid', 'uid');
    }

    public function showID2()
    {
        return $this->hasOne('App\Profile', 'uid', 'uid');
    }
}
