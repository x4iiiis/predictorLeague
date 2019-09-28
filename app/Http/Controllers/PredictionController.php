<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prediction;
use App\Match;
use App\User;
use Auth;

class PredictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->match as $match) {

            Prediction::create([
                'userID' => $request->userID,
                'matchID' => $match['id'],
                'homeGoals' => $match['homegoals'],
                'awayGoals' => $match['awayGoals']
                ]);   
        }

        $user = User::where('id', $request->userID)->first();
        $user->hasSubmitted = 1; 
        $user->save();

    }

    public function updateScores() {
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
            $user = User::where('id', $prediction->userID)->first(); // Relevant User
            $match = Match::where('id', $prediction->matchID)->first(); // Relevant Match

            $homeGoals = $match->homegoals; // Relevant Match Home Goals
            $awayGoals = $match->awayGoals; // Relevant Match Away Goals

            if(!is_null($homeGoals)) {

                //Correct Score
                if($prediction->homeGoals == $homeGoals && $prediction->awayGoals == $awayGoals) {
                    $user->correctScores += 1;
                }
                //Correct Outcome - Home Win
                else if($prediction->homeGoals > $prediction->awayGoals && $match->homegoals > $match->awayGoals) {
                    $user->correctOutcomes += 1;
                } 
                //Correct Outcome - Away Win
                else if($prediction->homeGoals < $prediction->awayGoals && $match->homegoals < $match->awayGoals) {
                    $user->correctOutcomes += 1;
                } 
                //Correct Outcome - Draw
                else if($prediction->homeGoals == $prediction->awayGoals && $match->homegoals == $match->awayGoals) {
                    $user->correctOutcomes += 1;
                } 
                $user->points = ($user->correctScores * 3) + $user->correctOutcomes;
                $user->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
