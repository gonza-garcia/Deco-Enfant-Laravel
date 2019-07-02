<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    // $path = storage_path('public/product');
    $path = storage_path('app/public/product'); //Atención con la ruta a la carpeta.

    return [
      'name' => $faker->sentence(3),
      'short_desc' => $faker->sentence(5),
      'long_desc' => $faker->sentence(8),
      'price'=>$faker->randomFloat(2, 300, 4000),
      'thumbnail'=> $faker->image($path, 480, 600,'cats', false),
    ];
});
