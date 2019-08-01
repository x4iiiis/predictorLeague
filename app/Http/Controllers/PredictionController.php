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
        //Figure out what match we're dealing with based on the first variable name (matchID comes after 'home')
        $firstMatchID = substr($request->request->keys()[1],4);
        $matchID = (int)$firstMatchID;

        //Loop through matches from there
        for ($i = 1; $i <= count($request->request->keys())-1; $i+=2) {

            $homeGoals = $request->all()[$request->request->keys()[$i]];
            $awayGoals = $request->all()[$request->request->keys()[$i+1]];

            //Validate request


            //Create match
            $newMatch = Prediction::create([
                'userID' => Auth::user()->id,
                'matchID' => $matchID,
                'homeGoals' => $homeGoals,
                'awayGoals' => $awayGoals
            ]);

            $matchID++;
        }
        
        Auth::user()->hasSubmitted = 1;
        Auth::user()->save();

        return redirect('/home');
    }

    public function updateScores() {
        //Update the users table's scores 
        $allPredictions = Prediction::all();

        foreach($allPredictions as $prediction) {
            $user = User::where('id', $prediction->userID)->first(); // Relevant User
            $match = Match::where('id', $prediction->matchID)->first(); // Relevant Match

            $homeGoals = $match->homegoals; // Relevant Match Home Goals
            $awayGoals = $match->awayGoals; // Relevant Match Away Goals

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
            $user->save();
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
