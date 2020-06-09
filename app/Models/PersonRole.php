<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonRole extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_id', 'role_id'
    ];
    
    public $timestamps = false;

    public function movies (){
        return $this->hasMany('App\Models\MoviePerson');
    }

    public function person (){
        return $this->belongsTo('App\Models\Person');
    }

    public function role (){
        return $this->belongsTo('App\Models\Role');
    }

}
