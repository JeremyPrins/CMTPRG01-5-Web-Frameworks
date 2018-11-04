<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{



    function reviews(){
        return $this->hasMany(Review::class);
    }

    function genres(){
        return $this->belongsToMany(Genre::class);

    }
}

