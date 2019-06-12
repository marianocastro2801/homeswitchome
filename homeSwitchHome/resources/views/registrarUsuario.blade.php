@extends('layouts.baseapp')
@section('content')
<style type="text/css">
	.fondo{
		margin-top: 50; 
		padding: 25px;  
		border-radius:25px; 
		background: black;
		margin-bottom: 60px;

	}
	.credit-card-div  span { padding-top:10px; }
	.credit-card-div img { padding-top:30px; }
	.credit-card-div .small-font { font-size:9px; }
	.credit-card-div .pad-adjust { padding-top:10px; }
</style>
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<!--Futura Publicidad-->
			@include('inc.mensajeError')
		</div>
		<div class="fondo text-center col-md-6">
			<form action="/registrar/validarRegistro" method="post">
				{{ csrf_field() }}
				<img class=" mb-4" src="/images/Completo.png" alt="" width="330" height="150">
		  		<hr>
		  		<h1 class="h3 mb-3 font-weight-normal text-white">Registrarse</h1>
		  		<hr>
		  		<div class="form-group row"> <!-- Full Name -->
		  			<div class="col-md-6">
				        <label for="nombre" class="control-label text-white">Nombre</label>
				        <input type="text" class="form-control" id="full_name_id" name="nombreUsuario" placeholder="Andres" value="{{ old('nombreUsuario') }}">
			        </div>
			        <div class="col-md-6">
				        <label for="apellido" class="control-label text-white">Apellido</label>
				        <input type="text" class="form-control" id="full_name_id" name="apellidoUsuario" placeholder="Perez" value="{{ old('apellidoUsuario') }}">
			        </div>
			    </div>
			    <div class="form-group">
			    	<label for="email" class="control-label text-white">Email</label>
                    <input id="email" name="email" type="text" placeholder="Correo Electronio" class="form-control" value="{{ old('email') }}">
                </div>
              	<div class="form-group row">
              		<div class="col-md-6">
              			<label for="pwd" class="control-label text-white">Contraseña</label>
              			<input type="password" class="form-control" name="contrasenia" id="pwd" placeholder="********">
              		</div>
              		<div class="col-md-6">
              			<label for="pwd2" class="control-label text-white">Confirme contraseña</label>
              			<input type="password" class="form-control" name="contrasenia_confirmation" id="pwd2" placeholder="********">
              		</div>
              	</div>
              	<div class="form-group">
              		<label for="dni" class="control-label text-white">Documento Nacional de identidad</label>
			        <input class="form-control" id="dni" name="dni" placeholder="99.129.880">
              	</div>
              	<div class="form-group">
					<label for="fechaNacimiento" class="control-label text-white">Fecha de Nacimiento</label>
					<input type="date" class="form-control form-control-sm" name="fechaNacimiento" id="fechaNacimiento" value="{{ old('fechaNacimiento') }}">
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#flipFlop">Tarjeta</button>
					<!-- The modal -->
					<div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="modalLabel">
										Datos de tarjeta
									</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="#" class="credit-card-div">
										<div class="panel panel-default" >
										 	<div class="panel-heading"> 
										      	<div class="row ">
										            <div class="col-md-12">
										                <input type="text" class="form-control" name="numeroTarjeta" placeholder="Ingrese el numero de la tarjeta" value="{{ old('numeroTarjeta') }}" />
										            </div>
										        </div>
										     	<div class="row ">
										            <div class="col-md-3 col-sm-3 col-xs-3">
										                <span class="help-block text-muted small-font" > Mes</span>
										                <input type="text" class="form-control" placeholder="MM" />
										            </div>
										         	<div class="col-md-3 col-sm-3 col-xs-3">
										                <span class="help-block text-muted small-font" > Año</span>
										                <input type="text" class="form-control" placeholder="YY" />
										            </div>
										        	<div class="col-md-3 col-sm-3 col-xs-3">
										                <span class="help-block text-muted small-font" >  CCV</span>
										                <input type="text" class="form-control" placeholder="CCV" />
										            </div>
										         	<div class="col-md-3 col-sm-3 col-xs-3">
														<img src="images/card.png" style="margin-top: 20px" height="50" width="50">
										         	</div>
										     	</div>
										     	<br>
										    	<div class="row">
										    		<div class="col-md-12 pad-adjust">
									            		<input type="text" class="form-control" placeholder="Nombre en la tarjeta" />
										        	</div>
										    	</div> 
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<div class="row ">
									    <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
									        <input type="submit"  class="btn btn-danger" value="Cancelar" />
									    </div>
									    <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
									        <input type="submit"  class="btn btn-warning btn-block" value="Guradar" />
									    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<a href="{{ url('/login/') }}" class="btn btn-danger btn-lg" data-toggle="" data-target="">Cancelar</a>
					<button type="submit" class="btn btn-success btn-lg" data-toggle="" data-target="">Registrar</button>
				</div>
			</form>

		</div>
		<div class="col-md-3">
			<!--Futura Publicidad-->
		</div>
	</div>
</div>

@endsection
