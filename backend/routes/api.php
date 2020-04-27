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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh')->name('refresh');
    Route::post('me', 'AuthController@me');
	
	Route::get('requerimiento/{requerimiento}', 'RequerimientoController@prueba');
	//Route::resource('requerimientos_lista', 'RequerimientoController');
	Route::post('requerimientos_lista', 'RequerimientoController@index');
	Route::get('requerimientos_lista', 'RequerimientoController@index');
});

Route::group([
    'prefix' => 'general',
], function () {
    Route::get('loadmodulos', 'GeneralController@loadmodulos');
});

	Route::group([
    'prefix' => 'files',
	], function () {
		Route::post('uploads', 'UploadFileController@store');
	});

Route::group(['middleware' => ['jwt.auth']], function () {

	
	Route::group([
    'prefix' => 'pos',
	], function () {
		//Route::get('prueba', 'ModuloController@prueba');
		Route::get('categorias', 'pos\CategoriaController@index');
		Route::post('categoriaslist', 'pos\CategoriaController@listado');
		Route::post('categorias', 'pos\CategoriaController@store');
		Route::put('categorias/{id}', 'pos\CategoriaController@update');
		Route::delete('categorias/{id}', 'pos\CategoriaController@destroy');
	
		Route::get('productos', 'pos\ProductoController@index');
		Route::post('productosPrecios', 'pos\ProductoController@storeproductoprecios');
		Route::get('productosPrecios/{id}', 'pos\ProductoController@productoprecios');
		Route::delete('productosPrecios/{id}', 'pos\ProductoController@destroyprecio');
		Route::post('productoslist', 'pos\ProductoController@listado');
		Route::post('productos', 'pos\ProductoController@store');
		Route::put('productos/{id}', 'pos\ProductoController@update');
		Route::delete('productos/{id}', 'pos\ProductoController@destroy');
		
		Route::post('clienteslist', 'pos\ClienteController@listado');
		Route::post('buscarcliente', 'pos\ClienteController@buscarcliente');
		Route::post('clientes', 'pos\ClienteController@store');
		Route::put('clientes/{id}', 'pos\ClienteController@update');
		Route::delete('clientes/{id}', 'pos\ClienteController@destroy');
		
		Route::post('ventaslist', 'pos\VentaController@listado');
		Route::delete('ventas/{id}', 'pos\VentaController@destroy');
		Route::post('ventas', 'pos\VentaController@store');
		
		
		Route::get('administracionpos', 'ModuloController@administracionPos');
		Route::post('impuestoslist', 'pos\administracion\ImpuestoController@listado');
		//Route::get('impuestoslist', 'pos\administracion\ImpuestoController@listado');
		Route::post('impuestos', 'pos\administracion\ImpuestoController@store');
		Route::put('impuestos/{id}', 'pos\administracion\ImpuestoController@update');
		Route::delete('impuestos/{id}', 'pos\administracion\ImpuestoController@destroy');
		
		Route::post('proveedoreslist', 'pos\administracion\ProveedorController@listado');
		//Route::get('proveedoreslist', 'pos\administracion\ProveedorController@listado');		

		Route::get('inventariodata', 'pos\administracion\InventarioController@inventariodata');


		
		
		
	});
});