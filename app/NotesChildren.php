<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotesChildren extends Model
{
    //protected $fillable = ['father_id'];
    protected $guarded = [];

    public function note()
    {
        return $this->belongsTo('App\Note', 'id', 'id');
    }
}
