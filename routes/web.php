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
Route::get('/inspectores/editar/{id}', 'InspectorController@editarInspector')->name('inspector-edit');
Route::post('/inspectores/actualizar', 'InspectorController@update')->name('inspector-update');
Route::get('/inspectores/eliminar/{id}', 'InspectorController@delete')->name('inspector-delete');


Route::get('/gestores', 'GestorController@listadoGestores')->name('listado-gestores');
Route::get('/gestores/listado', 'GestorController@tbody');
Route::post('/gestores/nuevo', 'GestorController@create');
Route::get('/gestores/editar/{id}', 'GestorController@editarGestor')->name('gestor-edit');
Route::post('/gestores/actualizar', 'GestorController@update')->name('gestor-update');
Route::get('/gestores/eliminar/{id}', 'GestorController@delete')->name('gestor-delete');


Route::get('/usuarios', 'UserController@listadoUsuarios')->name('listado-usuarios');
Route::get('/usuarios/listado', 'UserController@tbody');
Route::post('/usuarios/nuevo', 'UserController@create');
Route::get('/usuarios/editar/{id}', 'UserController@editarUsuario')->name('usuario-edit');
Route::post('/usuarios/actualizar', 'UserController@update')->name('usuario-update');
Route::get('/usuarios/eliminar/{id}', 'UserController@delete')->name('usuario-delete');
Route::get('/usuarios/verificar/{username}', 'UserController@verificarUsuario');
