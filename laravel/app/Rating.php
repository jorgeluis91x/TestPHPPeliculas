<?php

namespace TestMovies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    protected $fillable = [
        'fecha','client_id','movie_id','valoracion','user_id'
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
