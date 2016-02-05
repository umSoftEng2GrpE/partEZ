<?php

use Illuminate\Database\Seeder;

class PollResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PollResponse::class, 10)->create();
    }
}
