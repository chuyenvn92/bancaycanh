<?php

use Faker\Generator as Faker;

$factory->define(App\ProductTag::class, function (Faker $faker) {
    return [
        'product_id' => rand(1,100),
        'tag_id' => rand(1,50),
    ];
});
