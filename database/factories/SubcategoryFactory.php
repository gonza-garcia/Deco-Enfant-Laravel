<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Subcategory;
use Faker\Generator as Faker;

$factory->define(Subcategory::class, function (Faker $faker) {
    return [
          'name' => $faker->sentence(2),
          'category_id' => function () {
              return factory(App\Category::class)->create()->id;
          },
    ];
});
