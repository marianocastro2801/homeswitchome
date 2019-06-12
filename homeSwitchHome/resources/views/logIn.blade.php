@extends('layouts.baseapp')
@section('content')
<style type="text/css">
	.fondo{
		margin-top: 50; 
		padding: 25px;  
		border-radius:25px; 
		background: black;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<!--Futura Publicidad-->
			@include('inc.mensajeExito')
			@include('inc.mensajeError')
		</div>
		<div class="fondo text-center col-md-4">
			<form class="form-signin" action="/login/validarUsuario" method="post">
				{{ csrf_field() }}
		  		<img class=" mb-4" src="/images/Completo.png" alt="" width="330" height="150">
		  		<hr>
		  		<h3 class="font-weight-normal text-white">Iniciar Sesion</h3>
		  		<hr>
		  		<div class="form-group">
			  		<label for="inputEmail" class="control-label text-white">Nombre de Usuario</label>
			  		<input type="email" name="email" id="inputEmail" class="form-control" placeholder="andresperez@gmail.com" autofocus>
		  		</div>
		  		<div class="form-group">
					<label for="inputPassword" class="control-label text-white">Contraseña</label>
					<input type="password" name="contrasenia" id="inputPassword" class="form-control" placeholder="********">
				</div>
		  		<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
			</form>
		</div>
		<div class="col-md-4">
			<!--Futura Publicidad-->
		</div>
	</div>
</div>
@endsection