<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Cart;
use Faker\Generator as Faker;
$factory->define(Cart::class, function (Faker $faker) {
    $path = public_path('img/products');

    return [
      'name'            => $faker->sentence(3),
      'short_desc'      => $faker->sentence(5),
      'long_desc'       => $faker->sentence(8),
      'price'           => $faker->randomFloat(2, 300, 4000),
      'thumbnail'       => $faker->image($path, 480, 600,'cats', false),
      'cant'            => $faker->numberBetween($min = 0, $max = 1000),
      'discount'        => $faker->randomFloat(2, 10, 40),
      'cart_number'     => $faker->numberBetween($min = 1000, $max = 15000),
      'order_status_id' => \App\Order_status::inRandomOrder()->first()->id,
      'user_id'         => \App\User::inRandomOrder()->first()->id,
      'color_id'        => \App\Color::inRandomOrder()->first()->id,
      'size_id'         => \App\Size::inRandomOrder()->first()->id,
      'subcategory_id'  => \App\Subcategory::inRandomOrder()->first()->id,
    ];
});
