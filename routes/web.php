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

Route::get('/', 'SiteController@home')->name('home');

// contacto
Route::get('/contacto', 'SiteController@contacto')->name('contact');
Route::post('/contacto', 'SiteController@mensaje')->name('contact.mensaje');

Route::get('/perfil/{id}', 'SiteController@perfil')->name('profile');

//mensaje
Route::get('/message', 'SiteController@message')->name('message');


// Route::get   ('/products',                'ProductController@index') ->name('products.index');
// Route::get   ('/products/{product}',      'ProductController@show')  ->name('products.show');


// Route::group(['middleware' => ['auth','checkRole:1']], function () {

//     Route::get   ('/products/admin',          'ProductController@admin') ->name('products.admin');

//     Route::get   ('/products/create',         'ProductController@create')->name('products.create');
//     Route::get   ('/products/{product}/edit', 'ProductController@edit')  ->name('products.edit');

//     Route::post  ('/products',                'ProductController@store') ->name('products.store');

//     Route::put   ('/products/{product}',      'ProductController@update')->name('products.update');
//     Route::delete('/products/{product}',      'ProductController@delete')->name('products.delete');
// });
Route::get('/products/admin',               'ProductController@admin')->name('products.admin');
Route::get('/products/search/{buscado}',    'ProductController@search')->name('products.search');

Route::resources([
    'products' => 'ProductController',
]);

// Route::apiResource('products', 'ProductController');


// Route::get('/productos', 'ProductController@index');
// Route::get('/producto/{prod}', 'ProductController@show');
// Route::get('/sale', 'ProductController@sale');

Route::get('/usuarios/admin', 'UserController@admin');
Route::post('/usuario/add', 'UserController@add');
Route::post('/usuario/edit/{id}', 'UserController@update');


// Carrito
Route::get('/addToCart','CartController@store')->middleware('auth');
Route::post('/addToCart','CartController@store')->middleware('auth');

Route::get('/cart', 'CartController@index')->middleware('auth');
Route::post('/cart/{id}', 'CartController@destroy')->middleware('auth');
Route::put('/cart/update/{id}', 'CartController@update')->middleware('auth');
Route::get('/cart/close', 'CartController@closeCart')->middleware('auth');

Route::get('/history', 'CartController@history')->middleware('auth');
Route::get('/thanks', function(){
  view('alerts/thanks')->middleware('auth');
});
Route::get('/cart', 'CartController@totalPrice')->middleware('auth','checkRole:1');




// category
Route::get('/categories/{myCategory}', 'CategoryController@show')->name('categories.show');
