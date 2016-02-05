<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->name,
        'lastname' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    return [
        'uid' => '1',
        'name' => $faker->name,
        'location' => $faker->text,
        'description' => $faker->text,
        'date' => str_random(10),
        'stime' => str_random(10),
        'etime' => str_random(10),
    ];
});

$factory->define(App\Poll::class, function (Faker\Generator $faker) {
    return [
        'eid' => '1',
        'polltype' => 'date',
    ];
});


$factory->define(App\PollOption::class, function (Faker\Generator $faker) {
    return [
        'pid' => '1',
        'option' => $faker->text,
    ];
});