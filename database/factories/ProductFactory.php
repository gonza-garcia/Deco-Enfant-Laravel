<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;
use Faker\Provider\da_DK\Company;
use Illuminate\Support\Facades\File;

$factory->define(Product::class, function (Faker $faker) {
    // $path = storage_path('public/product');
    // $path = storage_path('app/public/product'); //Atención con la ruta a la carpeta.
    $path = public_path('img\products');

    //traer lista de nombres de archivos de imagenes
    $files = File::files(public_path('img\articles'));
    $images_list = [];
    foreach ($files as $file)
    {
        $images_list[] = './img/articles/' . pathinfo($file)['basename'];
    }

    return [
      'name'       => $faker->sentence(3),
      'short_desc' => $faker->sentence(5),
      'long_desc'  => $faker->sentence(8),
      'price'      => $faker->randomFloat(2, 300, 4000),
      'thumbnail'  => $faker->image($path, 480, 600,'cats', false),
      'thumbnail'  => $faker->randomElement($images_list),
      'stock'      => $faker->numberBetween($min = 0, $max = 1000),
      'discount'   => $faker->randomFloat(2, 10, 40),
      'color_id'   => function () {
            return \App\Color::inRandomOrder()->first()->id;
        },
      'size_id'    => function () {
            return \App\Size::inRandomOrder()->first()->id;
        },
      'subcategory_id'  => function () {
            return \App\Subcategory::inRandomOrder()->first()->id;
        },
    ];
});
