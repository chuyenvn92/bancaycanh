<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,100),
        'total_price' => rand(200000, 3000000),
        'status' => rand(0,1)
    ];
});
