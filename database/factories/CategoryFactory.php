<?php

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->unique()->randomElement(['laravel', 'php', 'queue', 'pusher', 'broadcasting', 'server', 'mysql']);
    return [
        'name' => $name,
        'slug' => $name
    ];
});
