<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\User;

class VoteController extends Controller
{
    public function Index() {
        return Vote::all();
    }

    public function openPolls() {
        foreach(User::all() as $user) {
            $user->hasVoted = 0;
            $user->save();
        }
    }

    public function closePolls() {
        foreach(User::all() as $user) {
            $user->hasVoted = 1;
            $user->save();
        }
    }

    public function clear() {
        Vote::truncate();
    }

    public function Store(Request $request) {
        
        Vote::create([
            'user_id' => $request->user_id,
            'vote' => $request['vote'],
        ]);  

        $user = User::where('id', $request->user_id)->first();
        $user->hasVoted = 1; 
        $user->save();
    }
}
