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
        'username'          => $faker->userName,
        'first_name'        => $faker->firstName($gender = 'male'|'female'),
        'last_name'         => $faker->lastName,
        'email'             => $faker->unique()->safeEmail,
        'password'          => bcrypt('aaaa'),
        'phone'             => $faker->numerify('### #########'),
        'date_of_birth'     => $faker->dateTimeThisCentury->format('Y-m-d'),
        'province_id'       => \App\Province::inRandomOrder()->first()->id,
        'sex_id'            => \App\Sex::inRandomOrder()->first()->id,
        'role_id'           => \App\Role::inRandomOrder()->first()->id,
        'user_status_id'    => \App\User_status::inRandomOrder()->first()->id,
        'email_verified_at' => NULL,
        'remember_token'    => Str::random(10),
    ];
});
