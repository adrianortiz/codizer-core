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
        // User
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role' => $faker->randomElement(['user', 'admin'])
    ];
});

$factory->define(App\Form::class, function (Faker\Generator $faker) {
    return [
        // Form
        'name' => $faker->name,
        'description' => $faker->email,
        'user_id' => bcrypt(str_random(10)),
    ];
});
