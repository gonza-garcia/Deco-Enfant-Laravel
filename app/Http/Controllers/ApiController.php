<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
//::::::::::::::::::::products:::::::::::::::::::::::::::::
    public function all_products()
    {
        return \App\Product::all();
    }

    public function single_product(\App\Product $product)
    {
        return $product;
    }

//:::::::::::::::::::::users:::::::::::::::::::::::::::::::
    public function all_users()
    {
        return \App\User::all();
    }

    public function single_user(\App\User $user)
    {
        return $user;
    }

//:::::::::::::::::::provinces:::::::::::::::::::::::::::::
    public function all_provinces()
    {
        return \App\Province::all();
    }

    public function all_provinces_from(\App\Country $country)
    {
        return $country->provinces;
    }

//:::::::::::::::::::countries:::::::::::::::::::::::::::::
    public function all_countries()
    {
        return \App\Country::all();
    }


}
