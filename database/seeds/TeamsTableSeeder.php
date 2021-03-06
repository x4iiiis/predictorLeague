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
        $this->ScottishPremiership();
        $this->ScottishChampionship();
        $this->PremierLeague();
    }

    public function ScottishPremiership() {
        
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
            'name' => 'Dundee United',
            'emblem' => 'img/clubEmblems/DundeeUnited.png',
            'league' => 'Scottish Premiership'
        ]);
        DB::table('teams')->insert([
            'name' => 'Hamilton Academical',
            'emblem' => 'img/clubEmblems/Hamilton.png',
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
    }

    public function ScottishChampionship() {
        
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
            'name' => 'Dunfermline Athletic',
            'emblem' => 'img/clubEmblems/Dunfermline.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Heart of Midlothian',
            'emblem' => 'img/clubEmblems/HeartOfMidlothian.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Inverness Caledonian Thistle',
            'emblem' => 'img/clubEmblems/Inverness.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Greenock Morton',
            'emblem' => 'img/clubEmblems/GreenockMorton.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Queen of the South',
            'emblem' => 'img/clubEmblems/QOTS.png',
            'league' => 'Scottish Championship'
        ]);
        DB::table('teams')->insert([
            'name' => 'Raith Rovers',
            'emblem' => 'img/clubEmblems/RaithRovers.png',
            'league' => 'Scottish Championship'
        ]);

    }

    public function PremierLeague() {

        DB::table('teams')->insert([
            'name' => 'Arsenal',
            'emblem' => 'img/clubEmblems/Arsenal.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Aston Villa',
            'emblem' => 'img/clubEmblems/AstonVilla.png',
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
            'name' => 'Crystal Palace',
            'emblem' => 'img/clubEmblems/CrystalPalace.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Everton',
            'emblem' => 'img/clubEmblems/Everton.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Fulham',
            'emblem' => 'img/clubEmblems/Fulham.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Leeds United',
            'emblem' => 'img/clubEmblems/LeedsUnited.png',
            'league' => 'Premier League'
        ]);
        DB::table('teams')->insert([
            'name' => 'Leicester City',
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
            'name' => 'West Bromwich Albion',
            'emblem' => 'img/clubEmblems/WestBrom.png',
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
