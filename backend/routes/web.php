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
/*Route::get('requerimiento/{requerimiento}', 'RequerimientoController@prueba');
Route::get('clienteslist', 'web\ClienteWebController@listado');
Route::resource('requerimientos_lista', 'RequerimientoController');*/
