<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Person extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'gender', 'details'
    ];

    public $timestamps = false;

    public function roles ()
    {
        return $this->hasMany('App\Models\PersonRole');
    }
}
