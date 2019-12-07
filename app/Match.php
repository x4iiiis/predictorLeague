<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'homeTeam', 
        'awayTeam', 
        'homeEmblem', 
        'awayEmblem', 
        'kickoff', 
        'homeGoals', 
        'awayGoals',
        'etp_available',
        'homeGoalsAET',
        'awayGoalsAET',
        'homeGoalsPens',
        'awayGoalsPens'
    ];

    protected $casts = [
        'kickoff' => 'datetime:l jS F Y H:i',
    ];

    public function predictions()
    {
        return $this->hasMany('App\Prediction');
    }
}
