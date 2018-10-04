<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'categorie_id' => $faker->numberBetween($min = 1, $max= 8),
        'subcategorie_id' =>  $faker->numberBetween($min = 1, $max= 11),
        'sku'  => $faker->numberBetween($min = 1, $max= 10000),
        'stock' =>  $faker->numberBetween($min = 1, $max= 100),
        'price' => $faker->numberBetween($min = 1, $max= 100),
        'description' => $faker->paragraph,
        'price_real' => $faker->numberBetween($min = 200, $max= 1000),
        'if_dolar' => $faker->numberBetween($min = 0, $max= 1),
        'destacado' => $faker->numberBetween($min = 0, $max= 1),
    ];
});
