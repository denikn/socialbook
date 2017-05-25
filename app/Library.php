<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
	protected $table='library';

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
