<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Trainer;
use Faker\Generator as Faker;

$factory->define(Trainer::class, function (Faker $faker) {

    return [
        //
        'user_id' => function () {
            return User::where('role', 'trainer')->get()->random();
        },
        'image' => 'person_1image_1581413469.jpg',
        'rating' => random_int(1, 5),
        'description' => $faker->sentence()
    ];
});
