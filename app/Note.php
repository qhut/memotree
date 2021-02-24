<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //protected $fillable = ['name', 'content', 'level', 'bookmarkt'];

    public function notesChildren()
    {
        return $this->hasOne('App\NotesChildren', 'id', 'id');
    }
}
