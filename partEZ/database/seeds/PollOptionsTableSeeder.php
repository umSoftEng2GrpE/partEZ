<?php

use Illuminate\Database\Seeder;

class PollOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PollOption::class, 50)->create();
    }
}
