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

Use App\User;

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');

Route::get('/inspectores', 'InspectorController@listadoInspectores')->name('listado-inspectores');
Route::get('/inspectores/listado', 'InspectorController@tbody');
Route::post('/inspectores/nuevo', 'InspectorController@create');
Route::get('/inspectores/editar/{id}', 'InspectorController@editarInspector');
Route::post('/inspectores/actualizar', 'InspectorController@update')->name('inspector-update');
Route::post('/inspectores/estatus', 'InspectorController@updateEstatus');

Route::get('/gestores', 'GestorController@listadoGestores')->name('listado-gestores');
Route::get('/gestores/listado', 'GestorController@tbody');
Route::post('/gestores/nuevo', 'GestorController@create');
Route::get('/gestores/editar/{id}', 'GestorController@editarGestor');
Route::post('/gestores/actualizar', 'GestorController@update')->name('gestor-update');
Route::post('/gestores/estatus', 'GestorController@updateEstatus');

Route::group(['middleware' => 'admin'], function () {
	Route::get('/usuarios', 'UserController@listadoUsuarios')->name('listado-usuarios');
});
Route::get('/usuarios/listado', 'UserController@tbody');
Route::post('/usuarios/nuevo', 'UserController@create');
Route::get('/usuarios/editar/{id}', 'UserController@editarUsuario');
Route::post('/usuarios/actualizar', 'UserController@update')->name('usuario-update');
Route::post('/usuarios/estatus', 'UserController@updateEstatus');
Route::get('/usuarios/verificar/{username}', 'UserController@verificarUsuario');
