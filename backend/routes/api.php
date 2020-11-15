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
		Route::get('categorias', 'pos\CategoriaController@index')->name('categorias_index');
		Route::post('categoriaslist', 'pos\CategoriaController@listado')->name('categorias_listado');
		Route::post('categorias', 'pos\CategoriaController@store')->name('categorias_store');
		Route::put('categorias/{id}', 'pos\CategoriaController@update')->name('categorias_update');
		Route::delete('categorias/{id}', 'pos\CategoriaController@destroy')->name('categorias_destroy');
	
		Route::get('productos', 'pos\ProductoController@index')->name('productos_index');
		Route::post('productosPrecios', 'pos\ProductoController@storeproductoprecios')->name('productos_store_precio');
		Route::get('productosPrecios/{id}', 'pos\ProductoController@productoprecios')->name('productos_precio');
		Route::delete('productosPrecios/{id}', 'pos\ProductoController@destroyprecio')->name('productos_destroy_precio');
		Route::post('productoslist', 'pos\ProductoController@listado')->name('productos_listado');
		Route::get('productos/barras/{codigo}', 'pos\ProductoController@getBarcode')->name('productos_barcode');
		Route::post('productos', 'pos\ProductoController@store')->name('productos_store');
		Route::put('productos/{id}', 'pos\ProductoController@update')->name('productos_update');
		Route::delete('productos/{id}', 'pos\ProductoController@destroy')->name('productos_destroy');
		
		Route::post('clienteslist', 'pos\ClienteController@listado')->name('clientes_listado');
		Route::post('buscarcliente', 'pos\ClienteController@buscarcliente')->name('clientes_buscar');
		Route::post('clientes', 'pos\ClienteController@store')->name('clientes_store');
		Route::put('clientes/{id}', 'pos\ClienteController@update')->name('clientes_update');
		Route::delete('clientes/{id}', 'pos\ClienteController@destroy')->name('clientes_destroy');
		
		Route::post('ventaslist', 'pos\VentaController@listado')->name('ventas_listado');
		Route::delete('ventas/{id}', 'pos\VentaController@destroy')->name('ventas_destroy');
		Route::post('ventas', 'pos\VentaController@store')->name('ventas_store');
		
		
		Route::get('administracionpos', 'ModuloController@administracionPos')->name('administracion_pos');;
		Route::post('impuestoslist', 'pos\administracion\ImpuestoController@listado')->name('administracion_listado_post');
		Route::get('impuestoslist', 'pos\administracion\ImpuestoController@listado')->name('administracion_listado_get');
		Route::post('impuestos', 'pos\administracion\ImpuestoController@store')->name('administracion_impuesto_store');
		Route::put('impuestos/{id}', 'pos\administracion\ImpuestoController@update')->name('administracion_impuesto_update');
		Route::delete('impuestos/{id}', 'pos\administracion\ImpuestoController@destroy')->name('administracion_impuesto_destroy');
		
		Route::post('proveedoreslist', 'pos\administracion\ProveedorController@listado')->name('proveedores_listado');
		//Route::get('proveedoreslist', 'pos\administracion\ProveedorController@listado');
		Route::post('proveedores', 'pos\administracion\ProveedorController@store')->name('proveedores_store');
		Route::put('proveedores/{id}', 'pos\administracion\ProveedorController@update')->name('proveedores_update');
		Route::get('dataformproveedor', 'pos\administracion\ProveedorController@dataformproveedor')->name('dataformproveedor');

		Route::get('inventariodata', 'pos\administracion\InventarioController@inventariodata')->name('inventario_data');


		
		
		
	});
});