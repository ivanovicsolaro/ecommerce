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

/**Rutas del front */
Route::get('/shop', 'FrontController@indexShop');