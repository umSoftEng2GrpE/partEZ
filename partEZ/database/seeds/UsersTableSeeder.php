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
        // create a test user
        DB::table('users')->insert(array(
            'firstname' => 'Simon',
            'lastname' => 'Tam',
            'email' => 'firefly@serenity.com',
            'password' => bcrypt('secret'),
        ));

        // create some more random users
        factory(App\User::class, 50)->create();
    }
}
