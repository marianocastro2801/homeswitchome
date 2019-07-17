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
		    	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-left: -60px; margin-right: 80px; margin-top: 70px">

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
					            	<img class="d-block w-100" src="/images/{{ $hospedaje->imagen }}" height="430" alt="First slide" >
					                <div class="carousel-caption d-none d-md-block">
														<div style="background:black; border-radius: 45px;margin-top: -390px">
															<h4 style="color: white;margin-bottom: -15px; font-family: serif;">
																		{{ $hospedaje->titulo  }}
																</h4>
																</div>
					                </div>
					            </div>
				            @else
				                <div class="carousel-item">
				                	<img class="d-block w-100" src="/images/{{ $hospedaje->imagen }}" height="430" >
				                	<div class="carousel-caption d-none d-md-block">
														<div style="background:black; border-radius: 45px;margin-top: -390px">
															<h4 style="color: white;margin-bottom: -15px;;font-family: serif">
				                      		{{ $hospedaje->titulo  }}
				                    	</h4>
				                    	</div>
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
				<br>
				<div class="float-left" style="margin-left: 100px">
			    <div class="btn-group">
			      <a href="#contacots"  class="btn-dark ml-5 btn-lg" data-toggle="modal" data-target="#contactos">Contactos</a>
			      <a href="#response" class="btn-dark ml-5 btn-lg" data-toggle="modal" data-target="#response">FAQ</a>
			      <div class="modal" id="response">
			        <div class="modal-dialog modal-lg">
			          <div class="modal-content">
			            <div class="modal-header">
			              <h5 class="modal-title">Preguntas Frecuentes</h5>
			              <button class="close" data-dismiss="modal">&times;</button>
			            </div>
			            <div class="modal-body">
			              <div class="list-group">
			                <div class="d-flex w-100 justify-content-between">
			                  <div class="">
			                    <h6>1- ¿Qué acciones podrá realizar cada uno de los usuarios?</h6>
			                    <p>Un usuario normal podrá ver distintas residencias, anotarse a subastas, ofertar en las subasta, reservar por hotsale, ver su perfil con estados de subastas y reservas.
			                      El usuario premium podrá hacer lo mismo, con la diferencia que se le cobra un monto de registro y un extra mensual. Y como beneficio podrá acceder directamente a la propiedad sin pasar por la etapa de inscripción a la subasta.
			                      En la etapa subastas ambos usuarios tienen los mismos “privilegios”.</p>
			                    <h6>2- ¿Un mismo usuario puede hacer a múltiples reservas?</h6>
			                    <p>Si, pero se maneja mediante un sistema de créditos. Este crédito será adquirido a cada usuario una vez se registren. El usuario recibirá la suma de dos créditos cada 1 año, y se descontará uno al reservar un hospedaje, ya sea por ganar una subasta, reservar un Hotsale o reservar directo siendo usuario Premium.
			                      Se tiene pensado que haya un mecanismo de comprar créditos, pero no será implementado por el momento.</p>
			                      <h6>3- ¿Qué sucede con los usuarios que no tengan suficiente saldo para pagar la cuota mensual?</h6>
			                      <p>Se le informa que no tienen suficiente crédito como para usar el sistema y se le da la opción de cambiar de tarjeta.</p>
			                      <h6>4- ¿Cuál es la demografía y alcance que apuntan?</h6>
			                      <p>Personas mayores de 18 años en América.</p>
			                  </div>
			                </div>
			              </div>
			              <div class="modal-footer">
			                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			              </div>
			            </div>
			          </div>
			        </div>
			      </div>
			      <div class="modal" id="contactos">
			        <div class="modal-dialog">
			          <div class="modal-content">
			            <div class="modal-header">
			              <h5 class="modal-title">Contacto</h5>
			              <button class="close" data-dismiss="modal">&times;</button>
			            </div>
			            <div class="modal-body">
			                  <div class="container-fluid">
			                    <div class="d-flex w-100 justify-content-between">
			                        <div class="row">
			                          <div class="col-md-12">
			                            <p><b>Direccion:</b> Calle 50 &, Av. 120, La Plata, Buenos Aires de Lunes a Viernes de 8 a 12.</p>
			                            <p><b>Email:</b> andreaperez@gmail.com</p>
			                            <p><b>Tel:</b> 221 - 4567434</p>
			                          </div>
			                        </div>
			                      </div>
			                    </div>
			              <div class="modal-footer">
			                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			              </div>
			            </div>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
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
