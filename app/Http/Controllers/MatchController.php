<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
                    'user', Auth::user(),
                    'matches', Match::all()->where('kickoff', '>', date('Y-m-d H:i:s'))
                ];
            }
            else { 
                // Show everyone's predictions on unresulted matches if the user has submitted
                // Would be ideal if this ran beyond kickoff so we could see what people were 
                // waiting on, to add to the fun of it all 
                return [
                    'user', Auth::user(),
                    'matches', Match::all()->where('kickoff', '>', date('Y-m-d H:i:s')),
                    'previouslySubmitted', true
                ];
            }
        }
        return redirect('/login');
    }

    public function resultedMatches() {

        //TEMP
        //dd(Match::first()->predictions()->get());

        if(Auth::user()) {

            $prevMatches = Match::orderBy('kickoff', 'desc')->where('kickoff', '<', date('Y-m-d H:i:s'))
                                        ->where('homegoals', '>=', 0)->get();
            

            return [
                'users', User::all(),
                'matches', $prevMatches,
            ];
        }
        return redirect('/login');
    }

    //For lazy loading results
    public function moreResultedMatches($counter) {
        if(Auth::user()) {

            $limit = 10;
            $resultedTotal = sizeof(
                                Match::orderBy('kickoff', 'desc')
                                    ->where('kickoff', '<', date('Y-m-d H:i:s'))
                                    ->where('homegoals', '>=', 0)
                                    ->get()
                                ) + 1;
            //dd(Match::find($counter));
            $prevMatches = Match::orderBy('kickoff', 'desc')
                                ->where('kickoff', '<', date('Y-m-d H:i:s'))
                                ->where('homegoals', '>=', 0)
                                ->find(range(
                                    $resultedTotal - (($counter) * $limit) - 1,
                                    $resultedTotal - ($counter * $limit) - $limit)
                                );
            
            return [
                'users', User::all(),
                'matches', $prevMatches,
            ];
        }
        return redirect('/login');
    }

    //For each Result.vue Component
    public function getMatchPredictions($matchID) {
        if(Auth::user()) {
            return [
                'predictions', Match::where('id', $matchID)->first()->predictions()->get()
            ];
        }
    }

    public function unresultedMatches() {
        if(Auth::user()) {
            if(Auth::user()->hasSubmitted == 1) {

                $unresultedMatches = Match::orderBy('kickoff')->where('homegoals', null)->get();

                $predictions = [];

                // foreach($unresultedMatches as $match) {
                //     array_push($predictions, Prediction::all()->where('match_id', '==', $match->id));
                // }

                foreach($unresultedMatches as $match) {
                    array_push($predictions, $match->predictions()->get());
                }

                return [
                    'users', User::all(),
                    'matches', $unresultedMatches,
                    'predictions', $predictions,
                ];
            }
        }
        return redirect('/login');
    }

    public function unresultedMatchesBackend() {
        if(Auth::user()) {

            return [
                'matches', Match::orderBy('kickoff')->where('homegoals', null)->get()
            ];
        }
        return redirect('/login');
    }

    public function resultedMatchesBackend() {
        if(Auth::user()) {            

            return [
                'matches', Match::orderBy('kickoff')->where('homegoals', '>=', 0)->get()
            ];
        }
        return redirect('/login');
    }


    public function index()
    {
        //return "Technical difficulties; Back soon. xoxo gossip girl";

        if(Auth::user()) {
            $users = User::all();
            $matches = Match::all()->where('kickoff', '>', date('Y-m-d H:i:s'));
            $prevMatches = Match::orderBy('id', 'desc')
                                        ->where('kickoff', '<', date('Y-m-d H:i:s'))
                                        ->where('homegoals', '>=', 0)
                                        ->simplePaginate(5);

            $predictions = []; 
            
            foreach(Match::all() as $match) {
                //dd($prevMatch->id);
                //dd(Prediction::all()->where('matchID', '==', $prevMatch->id));
                array_push($predictions, Prediction::all()->where('match_id', '==', $match->id));
            }
            //dd($predictions);



            //$prevMatches = Match::whereNotNull('homegoals')->get()->all();
            //dd($prevMatches);

            if(Auth::user()->hasSubmitted == 0) {
                return view('home')->with('users',$users)
                                    ->with('matches',$matches)
                                    ->with('prevMatches',$prevMatches)
                                    ->with('predictions',$predictions);
            }

            return view('home')->with('users',$users)
                                ->with('prevMatches',$prevMatches)
                                ->with('predictions',$predictions);
        }
        return redirect('/login');
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
            return view('backend');
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
            'awayEmblem' => $awayEmblem->emblem
        ]);

        return redirect('/backend');
    }

    public function updateScores(Request $request)
    {
        foreach($request->matches as $match) {

            if($match['homegoals'] != null) {

                $relevantMatch = Match::where('id', $match['id'])->first();
                $relevantMatch->homegoals = $match['homegoals'];
                $relevantMatch->awayGoals = $match['awayGoals'];
                $relevantMatch->save();
            }
        }
        return 'Scores Updated';
    }

    public function resetMatch(Request $request) {
        $relevantMatch = Match::where('id', $request->match['id'])->first();
        $relevantMatch->homegoals = null;
        $relevantMatch->awayGoals = null;
        $relevantMatch->save();
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
