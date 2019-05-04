<?php

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'authorable_type' => 'App\Models\Author',
        'authorable_id' => $faker->numberBetween(1,10),
        'content' => $faker->sentence
    ];
});
