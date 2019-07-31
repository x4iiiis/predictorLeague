<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Cheree Iannelli',
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'correctScores' => 0,
            'correctOutcomes' => 0
        ]);
        DB::table('users')->insert([
            'name' => 'Darren Wilson',
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'correctScores' => 0,
            'correctOutcomes' => 0
        ]);
        DB::table('users')->insert([
            'name' => 'Duncan McPherson',
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'correctScores' => 0,
            'correctOutcomes' => 0
        ]);
        DB::table('users')->insert([
            'name' => 'James Devlin',
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'correctScores' => 0,
            'correctOutcomes' => 0
        ]);
        DB::table('users')->insert([
            'name' => "Ryan O'Flaherty",
            'email' => 'ryan@x4iiiis.com',
            'password' => bcrypt('password'),
            'correctScores' => 0,
            'correctOutcomes' => 0
        ]);
        DB::table('users')->insert([
            'name' => 'Stuart Williamson',
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'correctScores' => 0,
            'correctOutcomes' => 0
        ]);
    }
}
