<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookmarkChapter extends Model
{
    protected $table='bookmarkchapter';

    protected $fillable = [
        'uid', 'id_books', 'id_chapter'
    ];

    /*protected $hidden = [
        'created_at', 'updated_at',
    ];*/

    public function books()
    {
        return $this->hasMany('App\Books','id_chapter', 'id_chapter');
    }
}
