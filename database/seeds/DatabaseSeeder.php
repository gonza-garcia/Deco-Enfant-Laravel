<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

      factory(\App\Country::class)->create();
      factory(\App\Province::class, 10)->create();

      factory(\App\Role::class, 20)->create();
      factory(\App\User_status::class, 3)->create();
      factory(\App\Color::class, 15)->create();
      factory(\App\Sex::class, 2)->create();
      factory(\App\Order_status::class, 3)->create();
      factory(\App\Shipping_status::class, 3)->create();
      factory(\App\Category::class, 8)->create();
      factory(\App\Size::class, 6)->create();

      factory(\App\Product::class, 20)->create();
    }
}
