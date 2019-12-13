<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CreateSitePermissions::class,
            UsersTableSeeder::class,
            TeamsTableSeeder::class,
            // MatchTableSeeder::class,
            // PredictionsTableSeeder::class,
        ]);
    }
}
