<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\User;
use App\Team;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $matches = Match::all();

        return view('home')->with('users',$users)
                            ->with('matches',$matches);
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
        //dd($homeEmblem);

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
