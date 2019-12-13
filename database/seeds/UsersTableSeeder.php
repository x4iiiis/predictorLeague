<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = User::create([
            'name' => 'x4iiiis',
            'email' => 'ryan@x4iiiis.com',
            'password' => bcrypt('password'),
        ]);
        $developer->assignRole('Developer');

        // factory(User::class, 9)->create();
    }
}
