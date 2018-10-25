<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    protected $guarded = [];

    function movies(){
        return $this->belongsToMany(Movie::class);
    }
}
