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
		Route::post('categorias', 'pos\CategoriaController@store');
		Route::put('categorias/{id}', 'pos\CategoriaController@update');
	
		Route::get('productos', 'pos\ProductoController@index');
		Route::post('productos', 'pos\ProductoController@index');
		Route::post('productos', 'pos\ProductoController@store');
		Route::put('productos/{id}', 'pos\ProductoController@update');
		
		Route::post('clienteslist', 'pos\ClienteController@listado');
		Route::post('clientes', 'pos\ClienteController@store');
		Route::put('clientes/{id}', 'pos\ClienteController@update');
		
		
	});
});