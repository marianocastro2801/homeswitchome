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


Route::get('/', 'SesionController@listarInicio');

Route::get('/sesion', function () {
    return view('iniciarSesion');
});

Route::post('/sesion/iniciar', 'SesionController@iniciar');

Route::get('/crearsubasta/{id}', ['as' => 'crearsubasta', 'uses' => 'SubastasController@crearSubasta']);

Route::post('/crearsubasta/validar', 'SubastasController@validar');

Route::get('/cargardetallesubasta/{id}', [ 'as' => 'cargardetallesubasta', 
	'uses' => 'SubastasController@detalleSubasta']);

// Route::get('/listarsubastas', 'SubastasController@listarSubastas');

Route::post('/pujarsubasta', 'SubastasController@pujar');

Route::get('/login', function () {
    return view('logIn');
});

Route::get('/register', function () {
    return view('registrarUsuario');
});

Route::post('/cerrarsubasta', 'SubastasController@cerrarSubasta');

Route::get('/crearhospedaje', 'HospedajeController@crearhospedaje');

Route::post('/crearhospedaje', 'HospedajeController@validar');

Route::get('/listarhospedajes', 'HospedajeController@listarHospedajes');

Route::get('/cargardetallehospedaje/{id}','HospedajeController@cargarDetalleHospedaje');

Route::post('/eliminarHospedaje','HospedajeController@eliminarHospedaje');

Route::get('/modificarHospedaje/{id}','HospedajeController@modificarHospedaje');

Route::post('/modificarHospedaje/{id}','HospedajeController@validarModificacion');