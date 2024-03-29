<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    static $password;
    $roles = [
        'user',
        'user',
        'user',
        'user',
        'user',
        'user',
        'trainer',
        'trainer',
        'trainer',
        'user',

    ];
    return [

        'name' => $faker->name,
        'email' => $faker->email(),
        'email_verified_at' => now(),
        'password' => $password ?: $password = bcrypt('secret'), // password
        'remember_token' => Str::random(10),
        'role' => $roles[random_int(0, 10)],
    ];
});
