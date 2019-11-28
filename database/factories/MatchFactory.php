<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Match;
use App\Team;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    
    $team1= Team::inRandomOrder()->first();
    $team2= Team::inRandomOrder()->first();
    
    return [
        'homeTeam' => $team1->name,
        'homeEmblem' => $team1->emblem,
        'awayTeam' => $team2->name,
        'awayEmblem' => $team2->emblem,
        'kickoff' => $faker->dateTimeBetween(1572217729, 1890515329),
    ];
});
