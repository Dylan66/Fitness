<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Booking;
use App\Service;
use App\Trainer;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        //
        'user_id' => function () {
            return User::where('role', 'user')->get()->random();
        },
        'trainer_id' => function () {
            return Trainer::all()->random();
        },
        'service_id' => function () {
            return Service::all()->random();
        },

        'start' => $faker->dateTimeBetween('now', '+2 weeks'),
        'end' => $faker->dateTimeBetween('now', '+3 weeks'),
    ];
});
