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

Use App\Usuario;

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/listado-inspectores', 'InspectorController@listadoInspectores')->name('listado-inspectores');
Route::get('/regitro-inspectores', 'InspectorController@registroInspector')->name('registro-inspector');
Route::post('/inspector/create', 'InspectorController@create')->name('inspector-create');
Route::get('/editar-inspector/{id}', 'InspectorController@editarInspector')->name('editar-inspector');
Route::post('/inspector/update', 'InspectorController@update')->name('inspector-update');
Route::get('delete/{id}', 'InspectorController@delete')->name('inspector-delete');

Route::get('/regitro-gestores', 'GestorController@registroGestores')->name('regitro-gestores');