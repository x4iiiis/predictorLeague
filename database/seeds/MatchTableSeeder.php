<?php

use Illuminate\Database\Seeder;

class MatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matches')->insert([
            'homeTeam' => 'Dundee',
            'awayTeam' => 'Motherwell',
            'kickoff' => '2019-09-03 15:00:00',
            'homeEmblem' => 'img/clubEmblems/Dundee.png',
            'awayEmblem' => 'img/clubEmblems/Motherwell.png'
        ]);
        DB::table('matches')->insert([
            'homeTeam' => 'Kilmarnock',
            'awayTeam' => 'Hamliton',
            'kickoff' => '2019-09-03 15:00:00',
            'homeEmblem' => 'img/clubEmblems/Kilmarnock.png',
            'awayEmblem' => 'img/clubEmblems/Hamilton.png'
        ]);
        DB::table('matches')->insert([
            'homeTeam' => 'Celtic',
            'awayTeam' => 'Aberdeen',
            'kickoff' => '2019-09-03 15:00:00',
            'homeEmblem' => 'img/clubEmblems/Celtic.png',
            'awayEmblem' => 'img/clubEmblems/Aberdeen.png'
        ]);
        DB::table('matches')->insert([
            'homeTeam' => 'Hearts',
            'awayTeam' => 'Hibernian',
            'kickoff' => '2019-09-03 15:00:00',
            'homeEmblem' => 'img/clubEmblems/HeartOfMidlothian.png',
            'awayEmblem' => 'img/clubEmblems/Hibernian.png'
        ]);
    }
}
