<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\User;
use App\Team;
use App\Prediction;
use Auth;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                array_push($predictions, Prediction::all()->where('matchID', '==', $match->id));
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
        $teams = Team::all();
        return view('backend')->with('teams',$teams);
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
