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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Aca comienzan los cambios


Route::get('/', 'IndexController@index');
// Route::get('Registro',)

// Route::get("/login",function(){
//   return view("login");
// });
// Route::get("/register",function(){
//   return view("register");
// });


Route::get('/productos', 'ProductController@index');
Route::get('/producto/{prod}', 'ProductController@show');
// Carrito
Route::get('producto/{id}/cart','CartController@store')->middleware('auth');

Route::get('/roles', 'RoleController@index');
Route::get('/role/{myRole}', 'RoleController@show');
Route::get('/roles/add', 'RoleController@create')->middleware('auth');
Route::post('/roles/add', 'RoleController@store')->middleware('auth');
Route::get("/DELETE/role/{id}","RoleController@delete")->middleware('auth');

Route::get('/colores', 'ColorController@index');
Route::get('/color/{myColor}', 'ColorController@show');
Route::get('/colores/add', 'ColorController@create')->middleware('auth');
Route::post('/colores/add', 'ColorController@store')->middleware('auth');
Route::get("/DELETE/color/{id}","ColorController@delete")->middleware('auth');
// Route::get("/color/{myColor}/edit","ColorController@edit");
// Route::put("/color/{id}","ColorController@update");


// sex
Route::get('/sexos', 'SexController@index');
Route::get('/sexo/{mySex}', 'SexController@show');
Route::get('/sexos/add', 'SexController@create')->middleware('auth');
Route::post('/sexos/add', 'SexController@store')->middleware('auth');
Route::get("/DELETE/sexo/{id}","SexController@delete")->middleware('auth');

// user_status
Route::get('/userStatuses', 'UserStatusController@index');
Route::get('/userStatus/{myUserStatus}', 'UserStatusController@show');
Route::get('/userStatuses/add', 'UserStatusController@create')->middleware('auth');
Route::post('/userStatuses/add', 'UserStatusController@store')->middleware('auth');
Route::get("/DELETE/userStatus/{id}","UserStatusController@delete")->middleware('auth');

// order_status
Route::get('/orderStatuses', 'OrderStatusController@index');
Route::get('/orderStatus/{myOrderStatus}', 'OrderStatusController@show');
Route::get('/orderStatuses/add', 'OrderStatusController@create')->middleware('auth');
Route::post('/orderStatuses/add','OrderStatusController@store')->middleware('auth');
Route::get("/DELETE/orderStatus/{id}","OrderStatusController@delete")->middleware('auth');

// shipping_status
Route::get('/shippingStatuses', 'ShippingStatusController@index');
Route::get('/shippingStatus/{myShippingStatus}', 'ShippingStatusController@show');
Route::get('/shippingStatuses/add', 'ShippingStatusController@create')->middleware('auth');
Route::post('/shippingStatuses/add', 'ShippingStatusController@store')->middleware('auth');
Route::get("/DELETE/shippingStatus/{id}","ShippingStatusController@delete")->middleware('auth');

// category
Route::get('/categorias', 'CategoryController@index');
Route::get('/categoria/{myCategory}', 'CategoryController@show');
Route::get('/categorias/add', 'CategoryController@create')->middleware('auth');
Route::post('/categorias/add', 'CategoryController@store')->middleware('auth');
Route::get("/DELETE/categoria/{id}","CategoryController@delete")->middleware('auth');
