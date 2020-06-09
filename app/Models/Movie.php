<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'genre', 'duration', 'release_date', 'description', 'rating_id'
    ];
    
    public $timestamps = false;

    public function rating (){
        return $this->belongsTo('App\Models\MovieRating');
    }

    public function people (){
        return $this->hasMany('App\Models\MoviePerson');
    }

}
