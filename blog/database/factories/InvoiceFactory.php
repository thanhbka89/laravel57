<?php

use Faker\Generator as Faker;

$factory->define(App\Invoice::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 50),
        'order_id' => $faker->numberBetween($min = 1, $max = 100),
        'paid_amount' => $faker->numberBetween($min = 1000, $max = 9000)
    ];
});
