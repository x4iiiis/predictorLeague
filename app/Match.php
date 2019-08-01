<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'homeTeam', 'awayTeam', 'homeEmblem', 'awayEmblem', 'kickoff', 'homeGoals', 'awayGoals'
    ];
}
