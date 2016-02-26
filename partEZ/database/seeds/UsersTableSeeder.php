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
        $this->addTestUsers();
        // create some random users
        factory(App\User::class, 10)->create();
    }

    /*
     * Add a user for the Selenium Tests
     */
    private function addTestUsers()
    {
        DB::table('users')->insert([
            'firstname' => 'test',
            'lastname' => 'user',
            'email' => 'partEZSelenium'.'@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'firstname' => 'test',
            'lastname' => 'user2',
            'email' => 'partEZSelenium2'.'@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
