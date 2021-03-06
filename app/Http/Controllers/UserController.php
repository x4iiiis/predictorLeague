<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Prediction;
use App\Match;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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
            'usersForLeague', $users, 'users', User::all()
        ];
    }

    public function update(Request $request) {
        if(Auth::user()) {
            $user = Auth::user();
            $user->name = $request->user['name'];
            $user->email = $request->user['email'];
            $user->accept_emails = $request->user['accept_emails'];
            $user->save();
        }
        return 'User updated';
    }

    public function checkEmail(Request $request) {
        return User::where('email', $request->email)->first();
    }

    public function resetPassword(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:users,id',
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

    public function whoAmI() {
        if(Auth::user()) {
            return [
                'user', Auth::user()
            ];
        }
        else {
            return [
                'user', new User([ "name" => "Guest", "hasSubmitted" => 0, "hasVoted" => 1 ])
            ];
        }
    }
}
