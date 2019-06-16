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

Route::get('/listarsubastas', 'SubastasController@listarSubastas');

Route::post('/pujarsubasta', 'SubastasController@pujar');

Route::post('/inscribirse', 'SubastasController@inscribirse');

Route::get('/buscar', 'SesionController@buscar');

Route::get('/login', function () {
    return view('logIn');
});

Route::post('/login/validarUsuario', 'SesionController@validarUsuario');

Route::get('/registrar', function () {
    return view('registrarUsuario');
});

Route::get('/modificarcuenta', 'SesionController@modificarCuenta');

Route::post('/modificarcuenta/datos', 'SesionController@validarDatos');

Route::post('/modificarcuenta/contrasenia', 'SesionController@validarContrasenia');

Route::post('/registrar/validarRegistro', 'SesionController@validarRegistro');

Route::post('/cerrarsubasta', 'SubastasController@cerrarSubasta');

Route::get('/crearhospedaje', 'HospedajeController@crearhospedaje');

Route::post('/crearhospedaje', 'HospedajeController@validar');

Route::get('/listarhospedajes', 'HospedajeController@listarHospedajes');

Route::get('/cargardetallehospedaje/{id}','HospedajeController@cargarDetalleHospedaje');

Route::post('/eliminarHospedaje','HospedajeController@eliminarHospedaje');

Route::get('/modificarHospedaje/{id}','HospedajeController@modificarHospedaje');

Route::post('/modificarHospedaje/{id}','HospedajeController@validarModificacion');




Route::get('/perfil', 'SesionController@perfilUsuario');

Route::get('/informacion', 'SesionController@informacion');

Route::get('/perfilAdministrador', 'SesionController@listarPerfilAdministrador');

Route::get('/pasarabasico/{id}','SesionController@pasarABasico');

Route::get('/pasarapremium/{id}','SesionController@pasarAPremium');

Route::get('/aceptarsolicitante/{id}','SesionController@aceptarSolicitante');

Route::get('/rechazarsolicitante/{id}','SesionController@rechazarSolicitante');