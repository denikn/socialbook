<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table='media';

    /*protected $fillable = [
        'uid', 'email', 'username', 'password',
    ];
	*/
    protected $hidden = [
        'id_media', 'id_books', 'id_chapter', 'type',
    ];

    public function media()
    {
        return $this->belongsTo('App\Media','id_media','id_media');
    }
}
