<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Cart;
use Faker\Generator as Faker;

$factory->define(Cart::class, function (Faker $faker) {
    $files = File::files(public_path('/img/products'));
    $images_list = [];
    foreach ($files as $file)
    {
        $images_list[] = './img/products\\' . pathinfo($file)['basename'];
    }

    return [
      'name'            => \App\Product::inRandomOrder()->first()->name,
      'short_desc'      => $faker->sentence(5),
      'long_desc'       => $faker->sentence(8),
      'thumbnail'       => $faker->randomElement($images_list),
      'price'           => $faker->randomFloat(2, 300, 4000),
      'discount'        => $faker->randomElement([0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,15,20,25,30,35,40,45,50]),
      'cant'            => $faker->numberBetween($min = 0, $max = 1000),
      'cart_number'     => $faker->unique()->numberBetween($min = 1000, $max = 15000),
      'status'          => $faker->randomElement([0,1]),
      'user_id'         => \App\User::inRandomOrder()->first()->id,
      'color_id'        => \App\Color::inRandomOrder()->first()->id,
      'size_id'         => \App\Size::inRandomOrder()->first()->id,
      'subcategory_id'  => \App\Subcategory::inRandomOrder()->first()->id,
    ];
});
