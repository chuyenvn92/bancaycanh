<?php

use Faker\Generator as Faker;

$factory->define(App\CommentPost::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,100),
        'post_id' => rand(1,50),
        'content' => $faker->text,
    ];
});
