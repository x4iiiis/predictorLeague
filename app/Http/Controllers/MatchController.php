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

            $prevMatches = Match::orderBy('kickoff', 'desc')->where('homeGoals', '>=', 0)->get();
            

            return [
                'users', User::all(),
                'matches', $prevMatches,
            ];
        }
        return redirect('/login');
    }

    public function countResultedMatches() {
        if(Auth::user()) {
            $resultedTotal = sizeof(Match::where('homeGoals', '>=', 0)->get());

            // dd($resultedTotal);

            return [
                'totalResultedMatches', $resultedTotal
            ];
        }
        return redirect('/login');
    }

    //For lazy loading results
    public function moreResultedMatches($counter) {
        if(Auth::user()) {

            $limit = 10;
            $resultedTotal = sizeof(Match::where('homeGoals', '>=', 0)->get());
            //dd(Match::find($counter));
            $prevMatches = Match::orderBy('kickoff', 'desc')
                                ->where('homeGoals', '>=', 0)
                                ->find(range(
                                    $resultedTotal - (($counter) * $limit) - 1,
                                    $resultedTotal - ($counter * $limit) - $limit)
                                );

            // dd($resultedTotal - (($counter) * $limit) - 1);
            // dd($resultedTotal - ($counter * $limit) - $limit);
            
            return [
                'users', User::all(),
                'matches', $prevMatches,
            ];
        }
        return redirect('/login');
    }

    //For each Result.vue Component
    public function getMatchPredictions($match_id) {
        if(Auth::user()) {
            return [
                'predictions', Match::where('id', $match_id)->first()->predictions()->get()
            ];
        }
    }

    public function unresultedMatches() {
        if(Auth::user()) {
            if(Auth::user()->hasSubmitted == 1) {

                $unresultedMatches = Match::orderBy('kickoff')->where('homeGoals', null)->get();

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
        //return "Technical difficulties; Back soon. xoxo gossip girl";

        if(Auth::user()) {
            $users = User::all();
            $matches = Match::all()->where('kickoff', '>', date('Y-m-d H:i:s'));
            $prevMatches = Match::orderBy('id', 'desc')
                                        ->where('homeGoals', '>=', 0);

            $predictions = []; 
            
            foreach(Match::all() as $match) {
                //dd($prevMatch->id);
                //dd(Prediction::all()->where('match_id', '==', $prevMatch->id));
                array_push($predictions, Prediction::all()->where('match_id', '==', $match->id));
            }
            //dd($predictions);



            //$prevMatches = Match::whereNotNull('homeGoals')->get()->all();
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
            $relevantMatch->kickoff = date('Y-m-d', strtotime($request->kickoff));
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
