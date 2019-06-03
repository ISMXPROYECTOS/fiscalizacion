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
Route::get('/regitro-inspectores', 'UserController@registroInspector')->name('registro-inspector');
Route::get('/regitro-gestores', 'UserController@registroGestores')->name('regitro-gestores');