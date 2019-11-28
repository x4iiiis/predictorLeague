<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Match;
use App\Prediction;

class PredictionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            foreach (Match::all() as $match) {
                Prediction::create([
                    'userID' => $user->id,
                    'match_id' => $match->id,
                    'homeGoals' => rand(0,9),
                    'awayGoals' => rand(0,9),
                ]);
            }
        }
    }
}
