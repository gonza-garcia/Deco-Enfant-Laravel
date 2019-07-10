<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Province;
use Faker\Generator as Faker;

$factory->define(Province::class, function (Faker $faker) {
    return [
          'name' => $faker->sentence(2),
          'country_id'   => function () {
                return \App\Country::inRandomOrder()->first()->id;
            },
          // 'country_id' => function () {
          //     return factory(App\Country::class)->create()->id;
          // },
    ];
});
