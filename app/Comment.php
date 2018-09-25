<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{


    function comment(){
        return $this->belongsTo(Review::class);
    }

    function user(){
        return $this->hasOne(User::class);
    }
}
