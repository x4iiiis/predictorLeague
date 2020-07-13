<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Prediction;
use App\Match;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LeagueTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('points', 'desc')
                ->orderBy('correctScores', 'desc')
                ->orderBy('correctOutcomes', 'desc')->get();

        // The following is for statistics purproses
        foreach($users as $user) {
            $user->totalPredictions = 0;

            foreach(Prediction::where('user_id', $user->id)->get() as $prediction) {
                if(!is_null(Match::where('id', $prediction->match_id)->first()->homeGoals)) {
                    $user->totalPredictions += 1;
                }
            }
        }

        return [
            'users', $users
        ];
    }

    public function whoAmI() {
        if(Auth::user()) {
            return [
                'user', Auth::user()
            ];
        }
        else {
            return [
                'user', new User([ "name" => "Guest", "hasSubmitted" => 0 ])
            ];
        }
    }

    public function checkEmail(Request $request) {
        return User::where('email', $request->email)->first();
    }

    public function resetPassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:Users,id',
            'newPassword' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        else {
            $user = User::where('id', $request->id)->first();
            $user->password = Hash::make($request->newPassword);
            $user->save();

            Auth::login($user);

            return 'Password updated successfully.';
        }
        
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
        //
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
