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
			@if(count($subastas) == 0)  
				<!--Si no hay publicacion-->
		    	<div class="container text-center bg-warning" style="border-radius: 25px; margin-top: 80px"><br><p><b>No hay subastas en este momento. Intente mas tarde</b></p><br></div>

		    @else 
		    	<!--Si hay subastas muestro en carrusel-->
		    	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-left: -60px; margin-right: 80px; margin-top: 60px">
					@foreach($subastas as $subasta)
			        	<ol class="carousel-indicators">
				          	@if($loop->first)
				            	<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				          	@endif
				            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->iteration }}"></li>
			          	</ol>
			        @endforeach
			        <div class="carousel-inner">
			            @foreach($subastas as $subasta)
				            <?php 
				                $hospedaje = DB::table('hospedajes')
				                    ->where('id', $subasta->id_hospedaje)
				                    ->first(); 
				            ?>
				            @if($loop->first)
					            <div class="carousel-item active">
					            	<img class="d-block w-100" src="/images/{{ $hospedaje->imagen }}" height="430" alt="First slide" style="border-radius: 25px;">
					                <div class="carousel-caption d-none d-md-block">
					                	<h1 style="color: black; border-color: black; margin-top: -350px">
					                        {{ $hospedaje->titulo  }}
					                    </h1>
					                    <p class="card-text mb-auto text-dark">Monto Base: ${{ $subasta->monto_base }}</p>
					                </div>
					            </div>
				            @else
				                <div class="carousel-item">
				                	<img class="d-block w-100" src="/images/{{ $hospedaje->imagen }}" height="430" style="border-radius: 25px;" >
				                	<div class="carousel-caption d-none d-md-block">
				                    	<h1 style="color: black; border-color: black; margin-top: -350px">
				                      		{{ $hospedaje->titulo  }}
				                    	</h1>
				                    	<p class="card-text mb-auto text-dark">Monto Base: ${{ $subasta->monto_base }}</p>
				                  	</div>
				                </div>
				            @endif
			        	@endforeach
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
		    @endif
		</div>
		<!--Registro e iniciar sesion-->
		<div class="fondo text-center col-md-4" style="margin-top: 0px; margin-bottom: 0px; border-bottom-right-radius: 25px; border-bottom-left-radius: 25px  ">
			<form class="form-signin" action="/login/validarUsuario" method="post" style="margin-top: 10px;">
				{{ csrf_field() }}
		  		<img class=" mb-4" src="/images/Completo.png" alt="" width="330" height="150">
		  		<div>
					@include('inc.mensajeExito')
					@include('inc.mensajeError')
				</div>
		  		<div style="padding-right: 30px; padding-left: 30px; padding-top: 30px">
		  			<h3 class="font-weight-normal text-white">Iniciar Sesion</h3>
		  			<div class="form-group">
			  			<input type="email" name="email" id="inputEmail" class="form-control" placeholder="andreaperez@gmail.com" value="{{old('email')}}" autofocus>
		  			</div>
		  			<div class="form-group">
						<input type="password" name="contrasenia" id="inputPassword" class="form-control" placeholder="********">
					</div>
		  			<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
		  		</div>
			</form>
			<a style="text-decoration: none" href="/registrar">
				<div style="padding-left: 30px; padding-right: 30px">
					<button style="margin-top: 10px; margin-bottom: -10px" class="btn btn-lg btn-warning btn-block" >
						Registrarse
					</button>
				</div> 
			</a>
			<br>
			<br>
		</div>
	</div>
</div>
@endsection