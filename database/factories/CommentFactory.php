<?php

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'author' => $faker->name,
        'email' => $faker->email,
        'ip' => $faker->ipv4,
        'content' => $faker->sentence
    ];
});
