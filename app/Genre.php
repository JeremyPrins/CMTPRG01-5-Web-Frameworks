<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    function movies(){
        return $this->belongsToMany(Movie::class);
    }
}
