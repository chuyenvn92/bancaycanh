<?php

use Faker\Generator as Faker;

$factory->define(App\CommentProduct::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,100),
        'product_id' => rand(1,100),
        'content' => $faker->text,
    ];
});
