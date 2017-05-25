<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table='books';

    /*protected $fillable = [
        'uid', 'friend', 'status',
    ];*/

    /*protected $hidden = [
        'created_at', 'updated_at',
    ];*/

    public function chapter()
    {
        return $this->hasMany('App\Chapter','id_books', 'id_books');
    }

    public function messageboard()
    {
        return $this->hasMany('App\Messageboard','id_books', 'id_books');
    }

    public function library()
    {
    	return $this->belongsTo('App\Library','id_books', 'id_books');
    }

    public function bookmark()
    {
    	return $this->belongsTo('App\Bookmark','id_books', 'id_books');
    }

    public function bookmarkchapter()
    {
        return $this->belongsTo('App\BookmarkChapter','id_books', 'id_books');
    }

    public function media()
    {
        return $this->hasMany('App\Media','id_chapter','id_chapter');
    }
}
