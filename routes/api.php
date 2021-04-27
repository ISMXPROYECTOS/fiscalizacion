<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'Api\Auth\LoginController@login')->name('api.v1.login');
Route::get('/ejercicios-fiscales', 'Api\EjercicioFiscalController@index')->name('api.v1.ejercicio-fiscal.index');
Route::get('/encargados', 'Api\EncargadoController@index')->name('api.v1.encargado.index');
Route::get('/tipos-de-inspeccion', 'Api\TipoInspeccionController@index')->name('api.v1.tipo-inspeccion.index');
Route::post('/inspecciones/nueva', 'Api\InspeccionController@create')->name('api.v1.inspeccion.create');

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*
Route::get('inspectores', function(){
	return datatables()->eloquent(App\Inspector::query())->toJson();
});
*/
