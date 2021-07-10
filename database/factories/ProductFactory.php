<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'product_category_id' => rand(1,2),
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->word,
        'import_price' => rand(100000, 1000000),
        'price' => rand(200000, 2000000),
        'discount' => rand(1,70),
        'image' => '',
    ];
});
