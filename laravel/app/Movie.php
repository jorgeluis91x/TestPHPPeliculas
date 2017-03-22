<?php

namespace TestMovies;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function category()
    {
        return $this->belongsTo('TestMovies\Category');
    }

    public function ratings()
    {
        return $this->hasMany('TestMovies\Rating');
    }
    
}
