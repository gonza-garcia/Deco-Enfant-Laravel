<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => '/', 'uses' => 'HomeController@index']);

Route::get('registro', ['as' => 'registro', 'uses' => 'HomeController@registro']);
Route::post('registro', ['as' => 'registro', 'uses' => 'HomeController@registro']);

Route::get('login', ['as' => 'login', 'uses' => 'HomeController@login']);
Route::post('login', ['as' => 'login', 'uses' => 'HomeController@login']);

Route::get('logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);

Route::get('users', ['as' => 'users', 'uses' => 'UserController@index']);
Route::get('/users/{id}',     "UserController@show");

Route::get('products', ['as' => 'products', 'uses' => 'ProductController@index']);
Route::get('/products/{id}',  "ProductController@show");

Route::get('/orders',         "OrderController@index");
Route::get('/orders/{id}',    "OrderController@show");
