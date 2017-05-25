<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table='bookmark';

    protected $fillable = [
        'uid', 'id_books'
    ];

    /*protected $hidden = [
        'created_at', 'updated_at',
    ];*/

    public function books()
    {
        return $this->hasMany('App\Books','id_books', 'id_books');
    }
}
