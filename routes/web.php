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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/install", function(){
  Artisan::call("migrate:fresh");
  Artisan::call("db:seed");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Aca comienzan los cambios

Route::get('/', 'IndexController@index');
Route::get('/', 'ProductController@destacados');


Route::get('/productos/admin', 'ProductController@admin');
Route::post('/producto/add', 'ProductController@add');
Route::post('/producto/edit/{id}', 'ProductController@update');

Route::get('/usuarios/admin', 'UserController@admin');
Route::post('/usuario/add', 'UserController@add');
Route::post('/usuario/edit/{id}', 'UserController@update');

Route::get('/productos', 'ProductController@index');
Route::get('/productos/buscar/{buscado}', 'ProductController@search');
Route::get('/productos/{myCategory}', 'CategoryController@show');
Route::get('/producto/{prod}', 'ProductController@show');
Route::get('/sale', 'ProductController@sale');

// Carrito
Route::get('/addToCart','CartController@store')->middleware('auth');
Route::post('/addToCart','CartController@store')->middleware('auth');

Route::get('/cart', 'CartController@index')->middleware('auth');
Route::post('/cart/{id}', 'CartController@destroy')->middleware('auth');
Route::put('/cart/update/{id}', 'CartController@update')->middleware('auth');
Route::get('/cart/close', 'CartController@closeCart')->middleware('auth');

Route::get('/history', 'CartController@history')->middleware('auth');
Route::get('/thanks', function(){
  view('thanks')->middleware('auth');
});
Route::get('/cart', 'CartController@totalPrice')->middleware('auth');




// category
Route::get('/categorias', 'CategoryController@index');
Route::get('/categoria/{myCategory}', 'CategoryController@show');
Route::get('/categorias/add', 'CategoryController@create')->middleware('auth');
Route::post('/categorias/add', 'CategoryController@store');
Route::get("/DELETE/categoria/{id}","CategoryController@delete")->middleware('auth');

// contacto
Route::get('/contacto', 'IndexController@contacto');
Route::post('/contacto', 'IndexController@mensaje');

Route::get('/perfil/{id}', 'IndexController@perfil')->name('perfil');
