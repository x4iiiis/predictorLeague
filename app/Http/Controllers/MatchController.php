<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Match;
use App\User;
use App\Team;
use App\Prediction;
use Auth;
use DateTime;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upcomingMatches() {

        if(Auth::user()) {
            if(Auth::user()->hasSubmitted == 0) {
                return [
                    'matches', Match::all()->where('kickoff', '>', date('Y-m-d H:i:s'))
                ];
            }
            else { 
                // Show everyone's predictions on unresulted matches if the user has submitted
                // Would be ideal if this ran beyond kickoff so we could see what people were 
                // waiting on, to add to the fun of it all 
                return [
                    'matches', Match::all()->where('kickoff', '>', date('Y-m-d H:i:s')),
                    'previouslySubmitted', true
                ];
            }
        }
        // return redirect('/login');

        return [
            'matches', Match::all()->where('kickoff', '>', date('Y-m-d H:i:s')),
        ];
    }

    public function resultedMatches() {

        //TEMP
        //dd(Match::first()->predictions()->get());

        if(Auth::user()) {

            $prevMatches = Match::orderBy('kickoff', 'desc')->where('homeGoals', '>=', 0)->get();
            

            return [
                'matches', $prevMatches,
            ];
        }
        return redirect('/login');
    }

    public function countResultedMatches() {
        $resultedTotal = sizeof(Match::where('homeGoals', '>=', 0)->get());

        // dd($resultedTotal);

        return [
            'totalResultedMatches', $resultedTotal
        ];
    }

    //For lazy loading results
    public function moreResultedMatches($counter) {

        $limit = 10;
        $resultedTotal = Match::orderBy('id', 'desc')->where('homeGoals', '>=', 0)->first()->id + 1;
        //dd(Match::find($counter));
        $prevMatches = Match::orderBy('id', 'desc')
                            ->where('homeGoals', '>=', 0)
                            ->find(range(
                                $resultedTotal - (($counter * $limit) - 1),
                                $resultedTotal - (($counter * $limit) - $limit))
                            );

        // dd($resultedTotal - (($counter) * $limit) - 1);
        // dd($resultedTotal - ($counter * $limit) - $limit);

        // dd(Match::orderBy('id', 'desc')->where('homeGoals', '>=', 0)->first()->id);
        
        return [
            'matches', $prevMatches,
        ];
    }

    //For each Result.vue Component
    public function getMatchPredictions($match_id) {
        return [
            'predictions', Match::where('id', $match_id)->first()->predictions()->get()
        ];
    }

    public function unresultedMatches() {
        
        $unresultedMatches = Match::orderBy('kickoff')->where('homeGoals', null)->get();
        
        $predictions = [];
        
        // foreach($unresultedMatches as $match) {
        //     array_push($predictions, Prediction::all()->where('match_id', '==', $match->id));
        // }
        
        if(Auth::user()) {
            if(Auth::user()->hasSubmitted == 1) {

                foreach($unresultedMatches as $match) {
                    array_push($predictions, $match->predictions()->get());
                }
        
                return [
                    'matches', $unresultedMatches,
                    'predictions', $predictions,
                ];
            }
        }
        // return redirect('/login');
        return [
            'matches', $unresultedMatches,
        ];
    }

    public function unresultedMatchesBackend() {
        if(Auth::user()) {

            return [
                'matches', Match::orderBy('kickoff')->where('homeGoals', null)->get()
            ];
        }
        return redirect('/login');
    }

    public function resultedMatchesBackend() {
        if(Auth::user()) {            

            return [
                'matches', Match::orderBy('kickoff', 'DESC')->where('homeGoals', '>=', 0)->get()
            ];
        }
        return redirect('/login');
    }


    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if(Auth::user()) {
            return [
                'teams', Team::all()
            ];
        }
        return redirect('login');
    }

    public function backend() {
        if(Auth::user()) {
            return view('backend')->with('users', User::all());
        }
        return redirect('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()) {
            $request->validate([
                'homeTeam' => 'required|max:32',
                'awayTeam' => 'required|max:32',
                'kickoff' => 'required|date'
            ]);

            $homeEmblem = Team::where('name', $request->homeTeam)->first();
            $awayEmblem = Team::where('name', $request->awayTeam)->first();

            $newMatch = Match::create([
                'homeTeam' => $request->homeTeam,
                'awayTeam' => $request->awayTeam,
                'kickoff' => $request->kickoff,
                'homeEmblem' => $homeEmblem->emblem,
                'awayEmblem' => $awayEmblem->emblem,
                'etp_available' => $request->etp_available
            ]);

            return redirect('/backend');
        }
        return redirect('login');
    }

    public function updateScores(Request $request)
    {
        if(Auth::user()) {
            foreach($request->matches as $match) {

                if($match['homeGoals'] != null) {

                    $relevantMatch = Match::where('id', $match['id'])->first();
                    $relevantMatch->homeGoals = $match['homeGoals'];
                    $relevantMatch->awayGoals = $match['awayGoals'];
                    $relevantMatch->homeGoalsAET = $match['homeGoalsAET'];
                    $relevantMatch->awayGoalsAET = $match['awayGoalsAET'];
                    $relevantMatch->homeGoalsPens = $match['homeGoalsPens'];
                    $relevantMatch->awayGoalsPens = $match['awayGoalsPens'];
                    $relevantMatch->save();

                    //Now loop through all of the predictions relating to this match, and update the
                    //corresponding user's score.

                    //Doing this here so that every time I push new results, I'm not fully calculating
                    //their entire scores from all of their predictions. That's excrutiatingly taxing
                    //and needless. If mistakes are made and scores need to be altered etc, I can use
                    //the '/recalculatetable' endpoint

                    $relevantPredictions = Prediction::where('match_id', $match['id'])->get();

                    foreach($relevantPredictions as $prediction) {
                        $user = User::where('id', $prediction->user_id)->first();

                        $homeGoals = $relevantMatch->homeGoals; 
                        $awayGoals = $relevantMatch->awayGoals;

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
                            if($relevantMatch->etp_available == 1 && $homeGoals == $awayGoals) {
                                if($relevantMatch->homeGoalsAET > $relevantMatch->awayGoalsAET || $relevantMatch->homeGoalsPens > $relevantMatch->awayGoalsPens) {
                                    $relevantMatch->winner = $relevantMatch->homeTeam;
                                }
                                else if($relevantMatch->homeGoalsAET < $relevantMatch->awayGoalsAET || $relevantMatch->homeGoalsPens < $relevantMatch->awayGoalsPens) {
                                    $relevantMatch->winner = $relevantMatch->awayTeam;
                                }
                                $relevantMatch->save();
            
                                //ET / Pens Predicted
                                if($prediction->homeGoals == $prediction->awayGoals && $prediction->winner == $relevantMatch->winner && $prediction->winner != null) {
                                    $user->correctOutcomes += 1;
                                }
                                //90 Minute Winner Picked - Home
                                else if($prediction->homeGoals > $prediction->awayGoals && $relevantMatch->winner == $relevantMatch->homeTeam) {
                                    $prediction->winner == $relevantMatch->homeTeam;
                                    $prediction->save();
                                    $user->correctOutcomes += 1;
                                }
                                //90 Minute Winner Picked - Away
                                else if($prediction->homeGoals < $prediction->awayGoals && $relevantMatch->winner == $relevantMatch->awayTeam) {
                                    $prediction->winner == $relevantMatch->awayTeam;
                                    $prediction->save();
                                    $user->correctOutcomes += 1;
                                }
                            }
            
                            $user->points = ($user->correctScores * 3) + $user->correctOutcomes;
                            $user->save();
                        }
                    }
                }
            }
            return 'Scores Updated';
        }
        else {
            return redirect('login');
        }
    }

    public function updateKickoff(Request $request)
    {
        if(Auth::user()) {

            $relevantMatch = Match::where('id', $request->id)->first();
            $relevantMatch->kickoff = date('Y-m-d H:i:s', strtotime($request->kickoff));
            $relevantMatch->save();
        }
        else {
            return redirect('login');
        }
    }

    public function updateETP(Request $request)
    {
        if(Auth::user()) {

            $relevantMatch = Match::where('id', $request->id)->first();
            $relevantMatch->etp_available = $request->etp_available;
            $relevantMatch->save();
        }
        else {
            return redirect('login');
        }
    }

    public function reverseFixture(Request $request)
    {
        if(Auth::user()) {
            $relevantMatch = Match::where('id', $request->id)->first();
            
            $newAwayTeam = $relevantMatch['homeTeam'];
            $newAwayEmblem = $relevantMatch['homeEmblem'];
            $newHomeTeam = $relevantMatch['awayTeam'];
            $newHomeEmblem = $relevantMatch['awayEmblem'];

            $relevantMatch['homeTeam'] = $newHomeTeam;
            $relevantMatch['homeEmblem'] = $newHomeEmblem;
            $relevantMatch['awayTeam'] = $newAwayTeam;
            $relevantMatch['awayEmblem'] = $newAwayEmblem;

            $relevantMatch->save();
        }
        else {
            return redirect('login');
        }
    }

    public function updateTeams(Request $request)
    {
        if(Auth::user()) {
            $relevantMatch = Match::where('id', $request->id)->first();

            $relevantMatch['homeTeam'] = $request->homeTeam;
            $relevantMatch['homeEmblem'] = Team::where('name', $request->homeTeam)->first()->emblem;
            $relevantMatch['awayTeam'] = $request->awayTeam;
            $relevantMatch['awayEmblem'] = Team::where('name', $request->awayTeam)->first()->emblem;

            $relevantMatch->save();
        }
        else {
            return redirect('login');
        }
    }

    public function resetMatch(Request $request) {
        if(Auth::user()) {
            $relevantMatch = Match::where('id', $request->match['id'])->first();
            $relevantMatch->homeGoals = null;
            $relevantMatch->awayGoals = null;
            $relevantMatch->save();
        }
        else {
            return redirect('login');
        }
    }

    public function cancelMatch(Request $request) {
        if(Auth::user()) {
            $relevantMatch = Match::where('id', $request->match['id'])->first();
            $relevantMatch->delete();
        }
        else {
            return redirect('login');
        }
    }

    public function resetSeason() {
        if(Auth::user()) {

            Schema::disableForeignKeyConstraints();
            Prediction::truncate();
            Match::truncate();
            Schema::enableForeignKeyConstraints();

            foreach(User::all() as $user) {
                $user->points = 0;
                $user->correctScores = 0;
                $user->correctOutcomes = 0;
                $user->hasSubmitted = true;
                $user->hasVoted = true;
                $user->save();
            }

            return 'Season reset; Good luck for the new one!';
        }
    }
}
