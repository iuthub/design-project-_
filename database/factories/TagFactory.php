<?php

use App\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['laravel','php','queue','pusher','auth','service','user','config','helper','collection']),
        'frequency' => $faker->numberBetween(1,50)
    ];
});
