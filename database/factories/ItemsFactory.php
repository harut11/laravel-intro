<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
    return [
        'title' => $faker->words(3, true),
		'content' => $faker->paragraph,
		'thumbnail' => str_random() . '.jpg',
    ];
});
