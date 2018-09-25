<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    function user(){
        return $this->belongsTo(User::class);
    }

    function movie (){
        return $this->belongsTo(Movie::class);
    }

    function comments(){
        return $this->hasMany(Comment::class);
    }
}


