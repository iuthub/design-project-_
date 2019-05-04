<?php

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1,5),
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'feature_image' => $faker->image('storage/app/public/images/posts',600,300, 'nature', false),
        'is_publish' => $faker->boolean
    ];
});
