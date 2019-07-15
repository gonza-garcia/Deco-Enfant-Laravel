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
        $this->call(ColorsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SexesTableSeeder::class);
        $this->call(SizesTableSeeder::class);

        $this->call(Order_StatusesTableSeeder::class);
        $this->call(User_StatusesTableSeeder::class);

        $this->call(SubcategoriesTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);

        $this->call(ProductsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        factory(\App\Product::class, 62)->create();
        factory(\App\User::class, 25)->create();
        // factory(\App\Cart::class, 47)->create();
    }
}
