<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
	protected $table='chapter';

    /*protected $fillable = [
        'uid', 'friend', 'status',
    ];*/

    /*protected $hidden = [
        'created_at', 'updated_at',
    ];*/

    public function books()
    {
        return $this->belongsTo('App\Books','id_books', 'id_books');
    }

    public function notes()
    {
        return $this->hasMany('App\Notes','id_chapter', 'id_chapter');
    }

    public function media()
    {
        return $this->hasMany('App\Media','id_chapter','id_chapter');
    }
}
