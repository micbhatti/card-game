<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoresBoard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_score', 'bot_score', 'user_won'
    ];

    //
    /**
     * Relation with user table
     *
     * Each game is related to one user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
