<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(6),
        'description' => $faker->sentence(20),
        'price' => $faker->numberBetween(50,300),
    ];
});
