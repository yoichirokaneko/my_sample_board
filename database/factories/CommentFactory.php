<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'post_id' => $faker->numberBetween($min = 1, $max = 20),
        'comment' => $faker->realText,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
