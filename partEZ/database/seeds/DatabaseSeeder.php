<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(PollsTableSeeder::class);
        $this->call(PollOptionsTableSeeder::class);
        $this->call(PollResponsesTableSeeder::class);
    }
}
