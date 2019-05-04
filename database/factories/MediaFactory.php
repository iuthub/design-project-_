<?php

use App\Models\Media;
use Faker\Generator as Faker;

$factory->define(Media::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'path' => $faker->image('storage/app/public/images/media', 640, 480, null, false),
        'extension' => '.jpg'
    ];
});
