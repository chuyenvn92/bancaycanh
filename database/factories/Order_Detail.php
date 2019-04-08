<?php

use Faker\Generator as Faker;

$factory->define(App\OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => rand(1,50),
        'attribute_id' => rand(1,100),
        'qty' => rand(1,10),
    ];
});
