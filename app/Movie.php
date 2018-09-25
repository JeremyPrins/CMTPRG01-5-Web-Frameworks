<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    function reviews(){
        return $this->belongsToMany(Review::class);
    }

    function genres(){
        return $this->hasMany(Genre::class);
    }
}

