<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
	static $number = 1;
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'category_id' => $faker->numberBetween($min = 1, $max = 4),
        'title' => $faker->word,
        'body' => $faker->realText,
        'created_at' => now(),
        'updated_at' => now(),
        'image' =>  $number++ . '.jpg',
    ];
});
