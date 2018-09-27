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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('logout', function(){
    Auth::logout();
    return view('welcome');
 });

Route::get('/home', 'HomeController@index')->name('home');


/**Rutas de perfil */
Route::get('perfil', ['uses' => 'MiCuentaController@getPerfil', 'as' => 'perfil']);
Route::post('actualizar-perfil', ['uses' => 'MiCuentaController@postPerfil', 'as' => 'update.perfil']);

/**Rutas de los productos back */
Route::resource('productos', 'ProductoController');
Route::get('productos/load-images/{id}', 'ProductoController@indexUploadImage');
Route::post('productos/upload-images/{id}', ['uses' => 'ProductoController@uploadImageProducts', 'as' => 'upload.images']);
Route::post('productos/remove-images', ['uses' => 'ProductoController@removeImageProducts', 'as' => 'remove.images']);
Route::get('productos/server-images/{id}', ['uses' => 'ProductoController@getServerImages', 'as' => 'server.images' ]);

/**Rutas del front */
Route::get('/shop', 'FrontController@indexShop');
Route::get('/producto/{slug}', 'ProductoController@detalleProducto');
Route::post('agregar-carrito', ['uses' => 'CartController@addItem', 'as' => 'carrito.addItem']);
Route::post('remover-carrito', ['uses' => 'CartController@removeItem', 'as' => 'carrito.removeItem']);
Route::get('ver-carrito', ['uses' => 'CartController@viewCart', 'as' => 'carrito.view']);
Route::get('ver-carrito-completo', ['uses' => 'CartController@view', 'as' => 'carrito.viewAll']);