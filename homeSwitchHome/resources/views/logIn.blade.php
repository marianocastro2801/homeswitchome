@extends('layouts.baseapp')
@section('content')
<style type="text/css">
	.fondo{
		margin-top: -13px; 
		padding: 25px;   
		background: black;
	}
</style>


<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div>
				<!--Futura Publicidad-->
				@include('inc.mensajeExito')
				@include('inc.mensajeError')
			</div>
			<div style="margin-top: 80px; margin-right: 50px">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				  </ol>
				  <div class="carousel-inner">
				  	<div class="carousel-item active">
				    	<img class="d-block w-100" src="/images/depto1.jpg" height="430" alt="First slide" style="border-radius: 20px">
				    	<div class="carousel-caption d-none d-md-block">
						    <b><h3 style="color: pink; border-color: black">Un Titulo</h3>
						    <p style="color: pink">Una breve descripcion</p></b>
						</div>
				    </div>
				    <div class="carousel-item">
				    	<img class="d-block w-100" src="/images/cabana1.jpg" height="430" alt="First slide" style="border-radius: 20px">
				    	<div class="carousel-caption d-none d-md-block">
						    <b><h3 style="color: pink; border-color: black">Un Titulo</h3>
						    <p style="color: pink">Una breve descripcion</p></b>
						</div>
				    </div>
				    <div class="carousel-item">
				    	<img class="d-block w-100" src="/images/hotel1.jpg" alt="First slide" height="430" style="border-radius: 20px">
				    	<div class="carousel-caption d-none d-md-block">
						    <b><h3 style="color: pink; border-color: black">Un Titulo</h3>
						    <p style="color: pink">Una breve descripcion</p></b>
						</div>
				    </div>
				  </div>
				  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
				<br><br><br><br>
			</div>
		</div>
		<div class="fondo text-center col-md-4" style="margin-top: 0px; margin-bottom: 0px ">
			<form class="form-signin" action="/login/validarUsuario" method="post" style="margin-top: 10px;">
				{{ csrf_field() }}
		  		<img class=" mb-4" src="/images/Completo.png" alt="" width="330" height="150">
		  		<div style="padding-right: 30px; padding-left: 30px; padding-top: 30px">
		  		<h3 class="font-weight-normal text-white">Iniciar Sesion</h3>
		  		<div class="form-group">
			  		<input type="email" name="email" id="inputEmail" class="form-control" placeholder="andresperez@gmail.com" autofocus>
		  		</div>
		  		<div class="form-group">
					<input type="password" name="contrasenia" id="inputPassword" class="form-control" placeholder="********">
				</div>
		  		<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
		  		</div>
			</form>
			
			<a class="" href="/registrar">
				<div style="padding-left: 30px; padding-right: 30px">
					<button style="margin-top: 10px; margin-bottom: -10px" class="btn btn-lg btn-warning btn-block" >
						Registrarse
					</button>
				</div> 
			</a>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	 
</script>
@endsection