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

$factory->define(App\DataAccess\Eloquent\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\DataAccess\Eloquent\Topic::class, function (Faker\Generator $faker) {
    return [
        'title'  => $faker->sentence(30),
        'body'   => $faker->text(),
        'status' => 1,
    ];
});

$factory->define(App\DataAccess\Eloquent\Like::class, function (Faker\Generator $faker) {
    return [
        'user_id'  => $faker->randomDigit(),
        'topic_id' => $faker->randomDigit(),
    ];
});