<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'              => $faker->userName,
        'first_name'        => $faker->firstName($gender = 'male'|'female'),
        'last_name'         => $faker->lastName,
        'email'             => $faker->unique()->safeEmail,
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // 'phone'             => $faker->regexify('[A-Za-z0-9]{20}'),
        'phone'             => $faker->numerify('### #########'),
        'date_of_birth'     => $faker->dateTimeThisCentury->format('Y-m-d'),
        'province_id'       => function () {
              return \App\Province::inRandomOrder()->first()->id;
          },
        'sex_id'            => function () {
              return \App\Sex::inRandomOrder()->first()->id;
          },
        'role_id'           => function () {
              return \App\Role::inRandomOrder()->first()->id;
          },
        'user_status_id'    => function () {
              return \App\User_status::inRandomOrder()->first()->id;
          },
        'email_verified_at' => now(),
        'remember_token'    => Str::random(10),
    ];
});
