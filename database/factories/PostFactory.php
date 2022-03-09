<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
   
    return [
        //
        'title' => $faker->title,
       
        'body' => $faker->paragraph,
        'image' => 'person_1image_1581413469.jpg',
    ];
});
