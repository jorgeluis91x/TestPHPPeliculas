<?php

namespace TestMovies;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function movies()
    {
        return $this->hasMany('TestMovies\Movie');
    }
}
