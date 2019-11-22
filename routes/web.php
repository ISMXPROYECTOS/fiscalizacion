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

/* Rutas Colonias */
Route::get('/colonias', 'ColoniaController@listadoColonias')->name('listado-colonias');
Route::get('/colonias/listado', 'ColoniaController@tbody');
Route::post('/colonias/nuevo', 'ColoniaController@create');
Route::get('/colonias/editar/{id}', 'ColoniaController@editarColonia');
Route::post('/colonias/actualizar', 'ColoniaController@update');

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
Route::get('/gestores/inspecciones/{id}', 'GestorController@inspeccionesPorGestor');

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
Route::get('/inspecciones/agregar-por-zonas', 'InspeccionController@vistaAgregarInspeccionPorZona')->name('vista-agregar-inspecciones-por-zona');
Route::get('/inspecciones/asignar', 'InspeccionController@vistaAsignarInspeccion')->name('vista-asignar-inspecciones');
Route::get('/inspecciones/listado', 'InspeccionController@tbody');
Route::post('/inspecciones/nuevo', 'InspeccionController@create')->name('crear-inspeccion');
Route::post('/inspecciones/nuevo-por-sm', 'InspeccionController@crearInspeccionesPorSM')->name('crear-inspeccion-por-sm');
Route::get('/inspecciones/editar/{id}', 'InspeccionController@editarInspeccion');
Route::post('/inspecciones/actualizar', 'InspeccionController@update');
Route::post('/inspecciones/estatus', 'InspeccionController@updateEstatus');
Route::post('/inspecciones/inspector', 'InspeccionController@updateInspector');
Route::post('/inspecciones/asignar-nuevo', 'InspeccionController@asignarInspecciones')->name('asignar-inspecciones');
Route::post('/inspecciones/obtener-folios', 'InspeccionController@obtenerFolios');
Route::get('/inspecciones/obtener-total-inspecciones/{id}/{anio}', 'InspeccionController@obtenerTotalInspecciones');
Route::post('/inspecciones/obtener-folios-inspecciones', 'InspeccionController@obtenerFoliosInspecciones');
Route::get('/inspecciones/informacion/{id}', 'InspeccionController@verMasInformacion')->name('ver-mas');
Route::post('/inspecciones/informacion/actualizar', 'InspeccionController@actualizarInformacionInspeccion')->name('actualizar-informacion-inspeccion');
Route::get('/inspecciones/inspeccion/limpiar/{id}', 'InspeccionController@limpiarInspeccion')->name('limpiar-inspeccion');
Route::get('/inspecciones/validar-folio-asignado/{id}', 'InspeccionController@validarFolioAsignado');
Route::get('/inspecciones/cambio-de-estatus', 'InspeccionController@cambiarEstatusAutomaticamente');
Route::post('/inspecciones/agregar-prorroga', 'InspeccionController@confirmarAgregarProrroga');

/* Rutas PDF */
Route::get('/pdf', 'PdfController@listadoInspeccionesParaDescargar')->name('listado-de-inspecciones-para-descargar');
Route::get('/pdf/listado', 'PdfController@tbody');
Route::get('/pdf/ver-gafete/{id}', 'PdfController@verGafete')->name('ver-gafete');
//Route::get('/pdf/validar-acta-inspeccion/{id}', 'PdfController@validarActaInspeccion');
//Route::get('/pdf/descargar-acta-inspeccion/{id}', 'PdfController@descargarActaInspeccion');
Route::get('/pdf/descargar-pdf-inspecciones/{id}', 'PdfController@descargarPdfInspecciones');
Route::get('/pdf/descargar-pdf-inspecciones-complejas/{id}', 'PdfController@descargarPdfInspeccionesComplejas');
Route::get('/pdf/validar-folios-asignados/{id}', 'PdfController@validarFoliosAsignados');
Route::get('/pdf/descargar-orden-clausura/{id}', 'PdfController@descargarOrdenClausura')->name('descargar-clausura');
Route::get('/pdf/inspecciones/{id}', 'PdfController@inspeccionesPorPaquete');
Route::get('/pdf/inspecciones/reasignar/{id}', 'PdfController@reasignarInspeccionesPorPaquete');
Route::post('/pdf/inspecciones/descargar-por-tipo-de-documento', 'PdfController@descargarInspeccionesPorTipoDeDocumento');

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

/* Rutas Comercios */
Route::get('/comercios', 'ComercioController@listadoComercios')->name('listado-comercios');
Route::get('/comercios/listado', 'ComercioController@tbody');
Route::post('/comercios/nuevo', 'ComercioController@create');
Route::get('/comercios/editar/{id}', 'ComercioController@editarComercio');
Route::post('/comercios/actualizar', 'ComercioController@update');
Route::post('/comercios/estatus', 'ComercioController@updateEstatus');
Route::get('/comercios/buscar/supermanzana/{domiciliofiscal}', 'ComercioController@buscarComercios');
Route::get('/comercios/buscar/nombre/{nombre}', 'ComercioController@buscarComerciosPorNombre');
Route::get('/comercios/sincronizar', 'ComercioController@comerciosDesdeSoap')->name('sincronizar-comercios');

/* Rutas Encargado */
Route::get('/encargado', 'EncargadoController@listadoEncargados')->name('listado-encargados');
Route::get('/encargado/listado', 'EncargadoController@tbody');
Route::post('/encargado/nuevo', 'EncargadoController@create');
Route::get('/encargado/editar/{id}', 'EncargadoController@editarEncargado');
Route::post('/encargado/actualizar', 'EncargadoController@update');
Route::post('/encargado/estatus', 'EncargadoController@updateEstatus');

/* Rutas Documentacion Requerida */
Route::get('/documentacion-requerida', 'DocumentacionRequeridaController@listadoDocumentacionRequerida')->name('listado-documentacion');
Route::get('/documentacion-requerida/listado', 'DocumentacionRequeridaController@tbody');
Route::post('/documentacion-requerida/nuevo', 'DocumentacionRequeridaController@create');
Route::get('/documentacion-requerida/editar/{id}', 'DocumentacionRequeridaController@editarDocumento');
Route::post('/documentacion-requerida/actualizar', 'DocumentacionRequeridaController@update');
Route::post('/documentacion-requerida/estatus', 'DocumentacionRequeridaController@updateEstatus');

/* Rutas Multas */
Route::post('/multas/agregar-multa', 'MultaController@confirmarMulta');