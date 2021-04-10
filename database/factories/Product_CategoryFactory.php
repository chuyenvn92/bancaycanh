<?php

use Faker\Generator as Faker;

$factory->define(App\ProductCategory::class, function (Faker $faker) {
    $name = $faker->name;
    $slug = str_slug($name);
    return [
        'name' => $name,
        'slug' => $slug,
    ];
});
