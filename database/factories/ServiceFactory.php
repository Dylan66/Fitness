<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
   
    return [
        //
        'name' => $faker->name,
        'description' => $faker->sentence(),
        'amount' => rand(1, 5),
        'image' => 'person_1image_1581413469.jpg',
    ];
});
