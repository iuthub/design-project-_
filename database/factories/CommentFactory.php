<?php

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'model_type' => 'App\Models\Author',
        'model_id' => $faker->numberBetween(1,10),
        'content' => $faker->sentence
    ];
});
