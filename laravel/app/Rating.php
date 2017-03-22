<?php

namespace TestMovies;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'fecha','client_id','movie_id','valoracion'
    ];

    public function movie()
    {
        return $this->belongsTo('TestMovies\Movie');
    }
     public function user()
    {
        return $this->belongsTo('TestMovies\User');
    }
}
