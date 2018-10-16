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

Route::get('/', 'FrontController@index');

Auth::routes();

Route::get('logout', function(){
    Auth::logout();
    return view('welcome');
 });

Route::get('/home', 'MiCuentaController@index')->name('home');


/**Rutas de perfil */
Route::get('perfil', ['uses' => 'MiCuentaController@getPerfil', 'as' => 'perfil']);
Route::post('actualizar-perfil', ['uses' => 'MiCuentaController@postPerfil', 'as' => 'update.perfil']);
Route::get('pedido/{nro_pedido}', 'MiCuentaController@detallePedido');
Route::get('pedido/{nro_pedido}', 'MiCuentaController@detallePedido');
Route::get('pedidos', ['uses' => 'MiCuentaController@listPedidos', 'as' => 'pedidos']);
Route::get('cambiar-contrasena', ['uses' => 'MiCuentaController@indexCambiarPassword', 'as' => 'cambiar-password']);
Route::post('actualizar-contrasena', ['uses' => 'MiCuentaController@postCambiarPassword', 'as' => 'update.password']);

/**Rutas back */

//Productos
Route::resource('productos', 'ProductoController');
Route::get('productos-create-massive', 'ProductoController@createCargaMasiva');
Route::get('productos/load-images/{id}', 'ProductoController@indexUploadImage');
Route::post('productos/upload-images/{id}', ['uses' => 'ProductoController@uploadImageProducts', 'as' => 'upload.images']);
Route::post('productos/remove-images', ['uses' => 'ProductoController@removeImageProducts', 'as' => 'remove.images']);
Route::get('productos/server-images/{id}', ['uses' => 'ProductoController@getServerImages', 'as' => 'server.images' ]);
Route::get('tikets', ['uses' => 'ProductoController@imprimirTikets', 'as' => 'productos.tikets' ]);


//Banner
Route::get('banners', 'ConfigController@indexBanner');
Route::post('update-banners',['uses' => 'ConfigController@updateBanner', 'as' => 'update.banner']);




/**Rutas del front */
Route::get('/shop', ['uses' => 'FrontController@indexShop', 'as' => 'shop.index']);
Route::get('/producto/{slug}', 'ProductoController@detalleProducto');

Route::post('agregar-carrito', ['uses' => 'CartController@addItem', 'as' => 'carrito.addItem']);
Route::post('remover-carrito', ['uses' => 'CartController@removeItem', 'as' => 'carrito.removeItem']);
Route::get('ver-carrito', ['uses' => 'CartController@viewCart', 'as' => 'carrito.view']);
Route::get('/carrito', 'CartController@index');
Route::get('ver-tabla-carrito', ['uses' => 'CartController@viewTable', 'as' => 'carrito.viewTable']);
Route::post('update-carrito', ['uses' => 'CartController@update', 'as' => 'carrito.update']);

//Checkout
Route::get('/checkout', ['uses' => 'CheckoutController@index', 'as' => 'checkout.index']);
Route::post('/finalizar-pedido', 'CheckoutController@finalizarPedido');


//Ventas

Route::resource('ventas', 'VentasController');
Route::get('ver-tabla-venta', ['uses' => 'CartController@viewTableVenta', 'as' => 'carrito.viewTableVenta']);
Route::get('ventas-cancelar/{id}', ['uses' => 'VentasController@destroy', 'as' => 'ventas.cancelar']);
Route::post('ventas-agregarPago/{id}', ['uses' => 'VentasController@agregarPagos', 'as' => 'ventas.add-pagos']);


//Customers
Route::get('buscar-cliente', ['uses' => 'CustomerController@find', 'as' => 'client.find']);
Route::resource('clientes', 'CustomerController');


//Payments

Route::get('buscar-pago', ['uses' => 'HelpersController@findPayment', 'as' => 'payment.find']);

