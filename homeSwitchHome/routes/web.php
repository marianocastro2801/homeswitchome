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

Route::get('/sesion', function () {
    return view('iniciarSesion');
});

Route::post('/sesion/iniciar', 'SesionController@iniciar');

Route::get('/crearsubasta/{id}', ['as' => 'crearsubasta', 'uses' => 'SubastasController@crearSubasta']);

Route::post('/crearsubasta/validar', 'SubastasController@validar');

Route::get('/cargardetallesubasta/{id}', [ 'as' => 'cargardetallesubasta', 
	'uses' => 'SubastasController@detalleSubasta']);

Route::get('/listarsubastas', 'SubastasController@listarSubastas');

Route::post('/pujarsubasta', 'SubastasController@pujar');

Route::get('/login', function () {
    return view('logIn');
});

Route::post('/cerrarsubasta', 'SubastasController@cerrarSubasta');

Route::get('/crearhospedaje', 'HospedajeController@crearhospedaje');

Route::post('/crearhospedaje/validar', 'HospedajeController@validar');
