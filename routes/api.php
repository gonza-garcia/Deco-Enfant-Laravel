<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', 'ProductController@api');
Route::get('/products/{id}', 'ProductController@single_product_api');

Route::get('/users',    'UserController@api');
Route::get('/users/{id}', 'UserController@single_user_api');

Route::get('/carts',    'CartController@api');
Route::get('/carts/{id}', 'CartController@single_cart_api');
