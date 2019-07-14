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

/* Rutas Home */
Route::get('/', 'HomeController@index')->name('home');

/* Rutas Inspectores */
Route::get('/inspectores', 'InspectorController@listadoInspectores')->name('listado-inspectores');
Route::get('/inspectores/listado', 'InspectorController@tbody');
Route::post('/inspectores/nuevo', 'InspectorController@create');
Route::get('/inspectores/editar/{id}', 'InspectorController@editarInspector');
Route::post('/inspectores/actualizar', 'InspectorController@update');
Route::post('/inspectores/estatus', 'InspectorController@updateEstatus');
Route::get('/inspectores/perfil/{hash}', 'InspectorController@perfil');

/* Rutas Gestores */

Route::get('/gestores', 'GestorController@listadoGestores')->name('listado-gestores');
Route::get('/gestores/listado', 'GestorController@tbody');
Route::post('/gestores/nuevo', 'GestorController@create');
Route::get('/gestores/editar/{id}', 'GestorController@editarGestor');
Route::post('/gestores/actualizar', 'GestorController@update');
Route::post('/gestores/estatus', 'GestorController@updateEstatus');

/* Rutas Usuarios */

Route::group(['middleware' => 'admin'], function () {
	Route::get('/usuarios', 'UserController@listadoUsuarios')->name('listado-usuarios');
});

Route::get('/usuarios/cambio-de-contraseña', 'UserController@cambiarPassword')->name('cambiar-password');
Route::post('/usuarios/actualizar-contraseña', 'UserController@updatePassword')->name('actualizar-password');
Route::get('/usuarios/listado', 'UserController@tbody');
Route::post('/usuarios/nuevo', 'UserController@create');
Route::get('/usuarios/editar/{id}', 'UserController@editarUsuario');
Route::post('/usuarios/actualizar', 'UserController@update')->name('usuario-update');
Route::post('/usuarios/estatus', 'UserController@updateEstatus');
Route::get('/usuarios/verificar/{username}', 'UserController@verificarUsuario');

/* Rutas Ejercicios Fiscales */

Route::get('/ejercicios-fiscales', 'EjercicioFiscalController@listadoEjerciciosFiscales')->name('listado-ejercicios-fiscales');
Route::get('/ejercicios-fiscales/listado', 'EjercicioFiscalController@tbody');
Route::post('/ejercicios-fiscales/nuevo', 'EjercicioFiscalController@create');
Route::get('/ejercicios-fiscales/editar/{id}', 'EjercicioFiscalController@editarEjercicioFiscal');
Route::post('/ejercicios-fiscales/actualizar', 'EjercicioFiscalController@update');
Route::post('/ejercicios-fiscales/estatus', 'EjercicioFiscalController@updateEstatus');

/* Rutas Inspecciones*/

Route::get('/inspecciones', 'InspeccionController@listadoInspecciones')->name('listado-inspecciones');
Route::get('/inspecciones/agregar', 'InspeccionController@vistaAgregarInspeccion')->name('vista-agregar-inspecciones');
Route::get('/inspecciones/asignar', 'InspeccionController@vistaAsignarInspeccion')->name('vista-asignar-inspecciones');
Route::get('/inspecciones/listado', 'InspeccionController@tbody');
Route::post('/inspecciones/nuevo', 'InspeccionController@create')->name('crear-inspeccion');
Route::get('/inspecciones/editar/{id}', 'InspeccionController@editarInspeccion');
Route::post('/inspecciones/actualizar', 'InspeccionController@update');
Route::post('/inspecciones/asignar-nuevo', 'InspeccionController@asignarInspecciones')->name('asignar-inspecciones');
Route::post('/inspecciones/obtener-folios', 'InspeccionController@obtenerFolios');
Route::get('/inspecciones/obtener-total-inspecciones/{id}', 'InspeccionController@obtenerTotalInspecciones');
Route::post('/inspecciones/obtener-folios-inspecciones', 'InspeccionController@obtenerFoliosInspecciones');
Route::post('/inspecciones/estatus', 'InspeccionController@updateEstatus');

/* Rutas PDF */
Route::get('/pdf', 'InspeccionController@pdf')->name('pdf');

/* Rutas Tipos Inspecciones*/

Route::get('/tipo-inspecciones', 'TipoInspeccionController@listadoTipoInspecciones')->name('listado-tipo-inspecciones');
Route::get('/tipo-inspecciones/listado', 'TipoInspeccionController@tbody');
Route::post('/tipo-inspecciones/nuevo', 'TipoInspeccionController@create');
Route::get('/tipo-inspecciones/editar/{id}', 'TipoInspeccionController@editarTipoInspeccion');
Route::post('/tipo-inspecciones/actualizar', 'TipoInspeccionController@update');

/* Rutas Estatus Inspecciones */

Route::get('/estatus-inspecciones', 'EstatusInspeccionController@listadoEstatusInspecciones')->name('listado-estatus-inspecciones');
Route::get('/estatus-inspecciones/listado', 'EstatusInspeccionController@tbody');
Route::post('/estatus-inspecciones/nuevo', 'EstatusInspeccionController@create');
Route::get('/estatus-inspecciones/editar/{id}', 'EstatusInspeccionController@editarEstatusInspeccion');
Route::post('/estatus-inspecciones/actualizar', 'EstatusInspeccionController@update');

/* Rutas Gafetes */

Route::get('/gafetes/registrar/{id}', 'GafetesController@registrar');
Route::post('/gafetes/generar', 'GafetesController@generar');

