<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
	$categories = App\Models\ItemCategory::select('id')->get()->pluck('id');
	$users = App\Models\User::select('id')->get()->pluck('id');
    return [
        'title' => $faker->words(3, true),
		'content' => $faker->paragraph,
		'thumbnail' => str_random() . '.jpg',
		'owner_id' => $faker->randomElement($users),
		'category_id' => $faker->randomElement($categories),
    ];
});
