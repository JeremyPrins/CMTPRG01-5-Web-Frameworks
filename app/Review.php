<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    function user(){
        return $this->belongsTo(User::class);
    }

    function movie (){
        return $this->belongsTo(Movie::class, 'movie_id', 'moviedb_id');
    }

    function comments(){
        return $this->hasMany(Comment::class);
    }



}


