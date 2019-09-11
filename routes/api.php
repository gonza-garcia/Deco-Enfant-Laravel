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

Route::get('/products',                      'ApiController@all_products');
Route::get('/products/{id}',                 'ApiController@single_product');

Route::get('/users',                         'ApiController@all_users');
Route::get('/users/{id}',                    'ApiController@single_user');

Route::get('/countries',                     'ApiController@all_countries');

Route::get('/provinces',                     'ApiController@all_provinces');

Route::get('/country/{country}/provinces',   'ApiController@all_provinces_from');

