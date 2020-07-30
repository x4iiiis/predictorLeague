<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prediction;
use App\Match;
use App\User;
use Auth;

class PredictionController extends Controller
{
    public function store(Request $request)
    {
        foreach($request->match as $match) {

            Prediction::create([
                'user_id' => $request->user_id,
                'match_id' => $match['id'],
                'homeGoals' => $match['homeGoals'],
                'awayGoals' => $match['awayGoals'],
                'winner' => $match['winner']
                ]);   
        }
        $user = User::where('id', $request->user_id)->first();
        $user->hasSubmitted = 1; 
        $user->save();
    }

    public function recalculateScores() {
        //Update the users table's scores 
        $allPredictions = Prediction::all();

        //Clear each user's scores
        foreach(User::all() as $user) {
            $user->correctScores = 0;
            $user->correctOutcomes = 0;
            $user->points = 0;
            $user->save();
        }

        foreach($allPredictions as $prediction) {
            $user = User::where('id', $prediction->user_id)->first(); // Relevant User
            $match = Match::where('id', $prediction->match_id)->first(); // Relevant Match

            $homeGoals = $match->homeGoals; // Relevant Match Home Goals
            $awayGoals = $match->awayGoals; // Relevant Match Away Goals

            if(!is_null($homeGoals)) {

                //Correct Score
                if($prediction->homeGoals == $homeGoals && $prediction->awayGoals == $awayGoals) {
                    $user->correctScores += 1;
                }
                //Correct Outcome - Home Win
                else if($prediction->homeGoals > $prediction->awayGoals && $homeGoals > $awayGoals) {
                    $user->correctOutcomes += 1;
                } 
                //Correct Outcome - Away Win
                else if($prediction->homeGoals < $prediction->awayGoals && $homeGoals < $awayGoals) {
                    $user->correctOutcomes += 1;
                } 
                //Correct Outcome - Draw
                else if($prediction->homeGoals == $prediction->awayGoals && $homeGoals == $awayGoals) {
                    $user->correctOutcomes += 1;
                } 

                //Cups / Playoffs
                if($match->etp_available == 1 && $homeGoals == $awayGoals) {
                    if($match->homeGoalsAET > $match->awayGoalsAET || $match->homeGoalsPens > $match->awayGoalsPens) {
                        $match->winner = $match->homeTeam;
                    }
                    else if($match->homeGoalsAET < $match->awayGoalsAET || $match->homeGoalsPens < $match->awayGoalsPens) {
                        $match->winner = $match->awayTeam;
                    }
                    $match->save();

                    //ET / Pens Predicted
                    if($prediction->homeGoals == $prediction->awayGoals && $prediction->winner == $match->winner && $prediction->winner != null) {
                        $user->correctOutcomes += 1;
                    }
                    //90 Minute Winner Picked - Home
                    else if($prediction->homeGoals > $prediction->awayGoals && $match->winner == $match->homeTeam) {
                        $prediction->winner == $match->homeTeam;
                        $prediction->save();
                        $user->correctOutcomes += 1;
                    }
                    //90 Minute Winner Picked - Away
                    else if($prediction->homeGoals < $prediction->awayGoals && $match->winner == $match->awayTeam) {
                        $prediction->winner == $match->awayTeam;
                        $prediction->save();
                        $user->correctOutcomes += 1;
                    }
                }
                $user->points = ($user->correctScores * 3) + $user->correctOutcomes;
                $user->save();
            }
        }
        return redirect('/');
    }

    public function lock() {
        if(Auth::user()) {
            foreach (User::all() as $user) {
                $user->hasSubmitted = 1;
                $user->save();
            }
        }
    }
    public function unlock() {
        if(Auth::user()) {
            foreach (User::all() as $user) {
                $user->hasSubmitted = 0;
                $user->save();
            }
        }
    }

    public function flipStatus(Request $request) {
        if(Auth::user()) {
            $user = User::where('id', $request->id)->first();

            $user->hasSubmitted = !$user->hasSubmitted;
            $user->save();
        }
    }
}
