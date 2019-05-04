<?php

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1,5),
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'is_publish' => $faker->numberBetween(1,3)
    ];
});
