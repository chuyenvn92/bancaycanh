<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'post_category_id' => rand(1,50),
        'user_id' => rand(1,100),
        'title' => $name,
        'slug' => str_slug($name),
        'content' => $faker->text,
        'image' => $faker->text,
    ];
});
