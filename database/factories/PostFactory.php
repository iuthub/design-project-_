<?php

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1,5),
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'feature_image' => $faker->image('storage/app/public/posts/images',600,300, null, false),
        'is_publish' => $faker->boolean
    ];
});
