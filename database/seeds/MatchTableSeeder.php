<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Match;
use App\Team;

class MatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //factory(Match::class, Team::count())->create();

        for ($i = 0; $i < Team::count() / 2 ; $i++) {
            $team1= Team::inRandomOrder()->first();
            $team2= Team::inRandomOrder()->first();
            
            Match::create([
                'homeTeam' => $team1->name,
                'homeEmblem' => $team1->emblem,
                'awayTeam' => $team2->name,
                'awayEmblem' => $team2->emblem,
                'kickoff' => $faker->dateTimeBetween(1572217729, 'now'),
                'homeGoals' => $faker->randomDigit,
                'awayGoals' => $faker->randomDigit,
            ]);
            
        }
            
        for ($i = 0; $i < Team::count() * rand(2,3); $i++) {
            $team1= Team::inRandomOrder()->first();
            $team2= Team::inRandomOrder()->first();
                
            Match::create([
                'homeTeam' => $team1->name,
                'homeEmblem' => $team1->emblem,
                'awayTeam' => $team2->name,
                'awayEmblem' => $team2->emblem,
                'kickoff' => $faker->dateTimeBetween('now', 1890515329),
            ]);
        }

    }
}
    
