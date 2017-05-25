<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table='notes';

    protected $fillable = [
        'uid', 'id_chapter', 'id_books', 'note', 'created_at', 'updated_at',
    ];

    /*protected $hidden = [
        'created_at', 'updated_at',
    ];*/

    public function chapter()
    {
        return $this->belongsTo('App\Chapter','id_chapter', 'id_chapter');
    }
}
