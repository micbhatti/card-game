<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * User relation with games
     *
     * One user can have many games
     */
    public function games()
    {
        return $this->hasMany('App\ScoresBoard');
    }

}
