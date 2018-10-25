<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    public $appends = ['avg_rating'];


    function reviews(){
        return $this->hasMany(Review::class);
    }

    function genres(){
        return $this->belongsToMany(Genre::class);

    }

    function getAvgRatingAttribute() {
        return "hoi";
    }

}

