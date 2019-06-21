@extends('layouts.baseapp')
@section('content')
<style type="text/css">
	.fondo{
		margin-top: 50;
		padding: 25px;
		border-bottom-left-radius:55px;
		border-bottom-right-radius: 55px;
		background: black;
		margin-bottom: 60px;

	}
	.credit-card-div  span { padding-top:10px; }
	.credit-card-div img { padding-top:30px; }
	.credit-card-div .small-font { font-size:9px; }
	.credit-card-div .pad-adjust { padding-top:10px; }
</style>


<div class="container">
	@include('inc.mensajeError')
	<div class="row">
		<div class="text-center col-md-6" style="margin-bottom: 60px">
			<form class=" fondo" action="/modificarcuenta/datos" method="post">
				{{ csrf_field() }}
				<h3 class="col-md-12 text-white">Editar Datos Personales</h3>
				<hr style="background: white">
				<div class="form-group row">
					<div class="col-md-12">
						<label for="correo" class="control-label text-white">Correo</label>
						<input type="text" class="form-control" name="email" value="{{old('email', session('email'))}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-6">
						<label for="nombre" class="control-label text-white">Nombre</label>
						<input type="text" class="form-control" name="nombreUsuario" value="{{old('nombreUsuario', session('nombreUsuario'))}}">
					</div>
					<div class="col-md-6">
						<label for="apellido" class="control-label text-white">Apellido</label>
						<input type="text" name="apellidoUsuario" class="form-control" value="{{old('apellidoUsuario', session('apellidoUsuario'))}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label for="fecha" class="control-label text-white">Fecha de nacimiento</label>
						<input type="date" name="fechaNacimiento" class="form-control" value="{{old('fechaNacimiento', session('fechaNacimiento'))}}">
					</div>
				</div>
				<hr style="background: white">
				<h3 class="col-md-12 text-white">Datos de Tarjeta</h3>
				<hr style="background: white">
				<div class="form-group row">
					<div class="col-md-12">
						<label for="numeroTarjeta"  class="control-label text-white">Numero de tarjeta</label>
						<input type="text" class="form-control" name="numeroTarjeta" value="{{old('numeroTarjeta', session('numeroTarjeta'))}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-8">
						<label for="fechaVto" class="control-label text-white">Fecha de Vencimiento (MM-DD)</label>
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="form-control" name="mesVencimiento" value="{{old('mesVencimiento', session('mesVencimiento'))}}">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="anioVencimiento" value="{{old('anioVencimiento', session('anioVencimiento'))}}">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<label for="codigoSeguridad" class="control-label text-white">Código seguridad</label>
						<input type="text" name="codigoSeguridad" class="form-control" value="{{old('codigoSeguridad', session('codigoSeguridad'))}}">
					</div>
				</div>
				<hr style="background: white">
				<div class="row">
					<div class="col-md-7"></div>
					<div class="col-md-2">
						<a style="text-decoration: none" class="btn btn-danger" href="/perfil">Cancelar</a>
					</div>
					<div class="col-md-3">
						<button class="btn btn-warning" type="submit">Guardar</button>
					</div>
				</div>
			</form>
		</div>
		<div class="text-center col-md-6">
			<form action="/modificarcuenta/contrasenia" class="fondo" method="post">
				{{ csrf_field() }}
				<h3 class="col-md-12 text-white">Editar Contraseña</h3>
				<hr style="background: white">
				<div class="row form-group">
					<div class="col-md-12">
						<label for="contraAnterior" class="control-label text-white">Contraseña anterior</label>
						<input class="form-control" type="password" name="contraseniaVieja">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<label for="nuevaContra" class="control-label text-white">Nueva contraseña</label>
						<input type="password" class="form-control" name="contraseniaNueva">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<label for="confNuevaContra" class="control-label text-white">Confirmar nueva contraseña</label>
						<input type="password" class="form-control" name="contraseniaNueva_confirmation">
					</div>
				</div>
				<hr style="background: white">
				<div class="row">
					<div class="col-md-7"></div>
					<div class="col-md-2">
						<a style="text-decoration: none" class="btn btn-danger"  href="/perfil">Cancelar</a>
					</div>
					<div class="col-md-3">
						<button class="btn btn-warning" type="submit">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
