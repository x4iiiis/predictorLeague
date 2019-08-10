<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Scottish Premiership
        DB::table('teams')->insert([
            'name' => 'Aberdeen',
            'emblem' => 'img/clubEmblems/Aberdeen.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Celtic',
            'emblem' => 'img/clubEmblems/Celtic.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Hamilton',
            'emblem' => 'img/clubEmblems/Hamilton.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Hearts',
            'emblem' => 'img/clubEmblems/HeartOfMidlothian.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Hibernian',
            'emblem' => 'img/clubEmblems/Hibernian.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Kilmarnock',
            'emblem' => 'img/clubEmblems/Kilmarnock.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Livingston',
            'emblem' => 'img/clubEmblems/Livingston.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Motherwell',
            'emblem' => 'img/clubEmblems/Motherwell.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Rangers',
            'emblem' => 'img/clubEmblems/Rangers.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Ross County',
            'emblem' => 'img/clubEmblems/RossCounty.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'St Johnstone',
            'emblem' => 'img/clubEmblems/StJohnstone.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'St Mirren',
            'emblem' => 'img/clubEmblems/StMirren.png',
            'league' => 'Scottish Premiership'
        ]);

        //Scottish Championship
        DB::table('teams')->insert([
            'name' => 'Alloa Athletic',
            'emblem' => 'img/clubEmblems/Alloa.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Arbroath',
            'emblem' => 'img/clubEmblems/Arbroath.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Ayr United',
            'emblem' => 'img/clubEmblems/AyrUnited.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Dundee',
            'emblem' => 'img/clubEmblems/Dundee.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Dundee United',
            'emblem' => 'img/clubEmblems/DundeeUnited.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Dunfermline',
            'emblem' => 'img/clubEmblems/Dunfermline.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Inverness',
            'emblem' => 'img/clubEmblems/Inverness.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Greenock Morton',
            'emblem' => 'img/clubEmblems/GreenockMorton.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Partick Thistle',
            'emblem' => 'img/clubEmblems/PartickThistle.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'QOTS',
            'emblem' => 'img/clubEmblems/QOTS.png',
            'league' => 'Scottish Championship'
        ]);

        //English Premier League
        DB::table('teams')->insert([
            'name' => 'Arsenal',
            'emblem' => 'img/clubEmblems/Arsenal.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'AstonVilla',
            'emblem' => 'img/clubEmblems/AstonVilla.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Bournemouth',
            'emblem' => 'img/clubEmblems/Bournemouth.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Burnley',
            'emblem' => 'img/clubEmblems/Burnley.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Brighton & Hove Albion',
            'emblem' => 'img/clubEmblems/Brighton.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Chelsea',
            'emblem' => 'img/clubEmblems/Chelsea.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'CrystalPalace',
            'emblem' => 'img/clubEmblems/CrystalPalace.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Everton',
            'emblem' => 'img/clubEmblems/Everton.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Leicester',
            'emblem' => 'img/clubEmblems/Leicester.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Liverpool',
            'emblem' => 'img/clubEmblems/Liverpool.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Manchester City',
            'emblem' => 'img/clubEmblems/ManCity.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Manchester United',
            'emblem' => 'img/clubEmblems/ManUtd.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Newcastle United',
            'emblem' => 'img/clubEmblems/Newcastle.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Norwich City',
            'emblem' => 'img/clubEmblems/Norwich.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Sheffield United',
            'emblem' => 'img/clubEmblems/SheffieldUnited.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Southampton',
            'emblem' => 'img/clubEmblems/Southampton.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Tottenham Hotspur',
            'emblem' => 'img/clubEmblems/Spurs.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Watford',
            'emblem' => 'img/clubEmblems/Watford.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'West Ham United',
            'emblem' => 'img/clubEmblems/WestHam.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Wolverhampton Wanderers',
            'emblem' => 'img/clubEmblems/Wolves.png',
            'league' => 'Premier League'
        ]);

    }
}
