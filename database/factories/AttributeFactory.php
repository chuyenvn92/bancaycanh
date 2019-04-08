<?php

use Faker\Generator as Faker;

$factory->define(App\Attribute::class, function (Faker $faker) {
    return [
        'product_id' => rand(1,100),
        'size_id' => rand(1,5),
        'color_id' => rand(1,4),
        'qty' => rand(50,400),
    ];
});
