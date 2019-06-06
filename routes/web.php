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
Route::post('/inspectores/nuevo', 'InspectorController@create');
Route::get('/editar-inspector/{id}', 'InspectorController@editarInspector')->name('editar-inspector');
Route::post('/inspector/update', 'InspectorController@update')->name('inspector-update');
Route::get('/inspector/delete/{id}', 'InspectorController@delete')->name('inspector-delete');
// Route::get('/regitro-inspectores', 'InspectorController@registroInspector')->name('registro-inspector');

Route::get('/gestores', 'GestorController@listadoGestores')->name('listado-gestores');
Route::post('/gestores/nuevo', 'GestorController@create');
Route::get('/editar-gestor/{id}', 'GestorController@editarGestor')->name('editar-gestor');
Route::post('/gestor/update', 'GestorController@update')->name('gestor-update');
Route::get('/gestor/delete/{id}', 'GestorController@delete')->name('gestor-delete');
// Route::get('/regitro-gestores', 'GestorController@registroGestores')->name('registro-gestores');

Route::get('/usuarios', 'UserController@listadoUsuarios')->name('listado-usuarios');
Route::post('/usuarios/nuevo', 'UserController@create');
Route::get('/editar-usuario/{id}', 'UserController@editarUsuario')->name('editar-usuario');
Route::post('/usuario/update', 'UserController@update')->name('usuario-update');
Route::get('/usuario/delete/{id}', 'UserController@delete')->name('usuario-delete');
// Route::get('/registro-usuario', 'UserController@registroUsuario')->name('registro-usuarios');


