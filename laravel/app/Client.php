<?php

namespace TestMovies;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function ratings()
    {
        return $this->hasMany('TestMovies\Rating');
    }
}
