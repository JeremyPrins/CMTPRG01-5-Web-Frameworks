<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    function reviews(){
        return $this->hasMany(Review::class,  'moviedb_id', 'movie_id');
    }

    function genres(){
        return $this->hasMany(Genre::class);
    }
}

