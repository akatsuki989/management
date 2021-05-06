<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomNumber,
        'product_name' => $faker->word,
        'price' => $faker->randomNumber,
        'stock' => $faker->randomNumber,
        'comment' => $faker->realText,
        'product_img' => $faker->word
    ];
});
