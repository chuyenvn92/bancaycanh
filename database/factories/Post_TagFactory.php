<?php

use Faker\Generator as Faker;

$factory->define(App\PostTag::class, function (Faker $faker) {
    return [
        'post_id' => rand(1,100),
        'tag_id' => rand(1,6),
    ];
});
