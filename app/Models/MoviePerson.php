<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoviePerson extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'character', 'movie_id', 'person_role_id'
    ];
    
    public $timestamps = false;

    public function movie (){
        return $this->belongsTo('App\Models\Movie');
    }

    public function person_role (){
        return $this->belongsTo('App\Models\PersonRole');
    }
}
