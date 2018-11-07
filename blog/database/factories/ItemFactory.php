<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        'item_name' => $faker->word,
        'price' => $faker->numberBetween($min = 1000, $max = 9000)
    ];
});
