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

        //English Premiership
        //cba the noo

    }
}
